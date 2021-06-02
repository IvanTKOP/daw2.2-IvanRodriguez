<?php

session_start(); // Para que esté en todas los scripts al hacer require_once

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage());
        exit('Error al conectar');
    }

    return $conexion;
}

function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
{

    $conexion = obtenerPdoConexionBD();

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY contrasenna=?";

    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $rs = $select->fetchAll();

    return $select->rowCount() == 1 ? $rs[0] : null;
}

function establecerSesionRam(array $arrayUsuario)
{

    $_SESSION["id"] = $arrayUsuario["id"];

    $_SESSION["identificador"] = $arrayUsuario["identificador"];
    $_SESSION["tipoUsuario"] = $arrayUsuario["tipoUsuario"];
    $_SESSION["nombre"] = $arrayUsuario["nombre"];
    $_SESSION["apellidos"] = $arrayUsuario["apellidos"];
}

function haySesionRamIniciada(): bool
{
    return isset($_SESSION["id"]);
}

function destruirSesionRamYCookie()
{
    session_destroy();
    actualizarCodigoCookieEnBD(null);
    borrarCookies();
    unset($_SESSION); // para dejarla como si nunca hubiese existido
}

function pintarInfoSesion()
{
    if (haySesionRamIniciada()) {
        echo "<span>Hola, <a href=''></a>$_SESSION[nombre] $_SESSION[apellidos] <a href='SesionCerrar.php'>Cerrar Sesión</a></span>";
    } else {
        echo "<a href='SesionInicioFormulario.php'>Iniciar Sesión</a>";
    }
}

// COOKIES

function obtenerUsuarioPorCodigoCookie(string $identificador, string $codigoCookie): ?array
{
    $conexion = obtenerPdoConexionBD();

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY codigoCookie=?";

    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $codigoCookie]);
    $rs = $select->fetchAll();

    return $select->rowCount() == 1 ? $rs[0] : null;
}

function actualizarCodigoCookieEnBD(?string $codigoCookie) // ? se pone para permitir que $codigoCookie sea null o en este caso string

{
    $conexion = obtenerPdoConexionBD();

    $sql = "UPDATE Usuario SET codigoCookie=? WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $_SESSION["id"]]);
}

function borrarCookies()
{
    setcookie("identificador", "", time() - 3600);
    setcookie("codigoCookie", "", time() - 3600);
}

function establecerSesionCookie(array $arrayUsuario)
{
    $codigoCookie = generarCadenaAleatoria(32); // creamos un codigo cookie complejo

    actualizarCodigoCookieEnBD($codigoCookie);

    // Creamos cookies
    setcookie("identificador", $arrayUsuario["identificador"], time() + 3600);
    setcookie("codigoCookie", $codigoCookie, time() + 3600);
}

function intentarCanjearSesionCookie(): bool
{
    if (isset($_COOKIE["identificador"]) && isset($_COOKIE["codigoCookie"])) {
        $arrayUsuario = obtenerUsuarioPorCodigoCookie($_COOKIE["identificador"], $_COOKIE["codigoCookie"]); // si existen las cookies obtenemos el usuario

        if ($arrayUsuario) { // si no hay errores establecemos sesiones
            establecerSesionRam($arrayUsuario);
            establecerSesionCookie($arrayUsuario);
            return true;
        } else { // sino borramos
            borrarCookies();
            return false;
        }
    } else { // sino borramos
        borrarCookies();
        return false;
    }
}

// GENERAL

function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') - 1; $i != $longitud; $x = rand(0, $z), $s .= $a[$x], $i++);
    return $s;
}

function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}
