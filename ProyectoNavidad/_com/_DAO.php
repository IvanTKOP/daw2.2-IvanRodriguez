<?php 
require_once "_com/_Varios.php";
require_once "_com/_Clases.php";

class DAO 
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD() 
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "fut"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }
    
        return $pdo;
    }

    private static function ejecutarConsultaObtener(string $sql, array $parametros): ?array
    {
        if(!isset(DAO::$pdo)) DAO::$pdo = 
        DAO::obtenerPdoConexionBD();

        $select = DAO::$pdo->prepare($sql);
        $select->execute($parametros);
        $resultado = $select->fetchAll();
        return $resultado;
    }

    public static function ejecutarConsultaActualizar(string $sql, array $parametros): int
    {
        if (!isset(DAO::$pdo)) DAO::$pdo = DAO::obtenerPdoConexionBd();

        $sentencia = DAO::$pdo->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->rowCount();
    }

    private static function ejecutarConsultaMostrar(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rsJugadoresDelaCategoria = $select->fetchAll();

        foreach ($rsJugadoresDelaCategoria as $fila) {
            echo "$fila[nombre]";
        }
        return $rsJugadoresDelaCategoria;
    }

    /*FUNCIONES PARA USUARIO*/

    private static function usuarioCrearDesdeRs(array $usuario):Usuario
    {
        return new Usuario($usuario["id"], $usuario["usuario"], $usuario["contrasenna"]);
    }

    public static function obtenerUsuario(string $usuario, string $contrasenna): ? Usuario 
    {
        $rs = self::ejecutarConsultaObtener("SELECT * FROM usuario WHERE usuario=? AND contrasenna =?", [$usuario, $contrasenna]);
        if ($rs) return self::usuarioCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function marcarSesionComoIniciada($usuario)
    {
        $_SESSION["id"] = $usuario->getId();
        $_SESSION["usuario"] = $usuario->getUsuario();
        $_SESSION["contrasenna"] = $usuario->getContrasenna();
    }

    function generarCadenaAleatoria(int $longitud): string
    {
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
        return $s;
    }

    public static function establecerSesionCookie()
    {
        $arrayUsuario = DAO::obtenerUsuario($_REQUEST["usuario"], $_REQUEST["contrasenna"]);
        $codigoCookie = generarCadenaAleatoria(32);
        self::ejecutarConsultaObtener("UPDATE usuario SET codigoCookie=? WHERE usuario=?",
            [$codigoCookie, $arrayUsuario->getUsuario()]
        );
        $arrayCookies["usuario"] = setcookie("usuario", $arrayUsuario->getUsuario(), time() + 60 * 60);
        $arrayCookies["codigoCookie"] = setcookie("codigoCookie", $codigoCookie, time() + 60 * 60);
    }

    public static function haySesionIniciada(): bool
    {
        return isset($_SESSION["id"]) ? true : false;
    }

    public static function cerrarSesion()
    {
        session_destroy();
        setcookie('codigoCookie', "");
        setcookie('usuario',"");
        unset($_SESSION);
    }

    public static function borrarCookies()
    {
        setcookie("usuario", "", time() - 3600);
        setcookie("codigoCookie", "", time() - 3600);
    }


/* FUNCIONES PARA JUGADOR*/

public static function jugadorObtenerPorId(int $id): ?Jugador
{
    $rs = self::ejecutarConsultaObtener("SELECT * FROM jugador WHERE id=?", [$id]);
    if ($rs) return self::jugadorCrearDesdeRs($rs[0]);
        else return null;
}

public static function jugadorObtenerTodos(): array
{
    $datos = [];
    $rs = self::ejecutarConsultaObtener("SELECT * FROM jugador ORDER BY id", []);

    foreach ($rs as $fila) {
        $jugador = self::jugadorCrearDesdeRs($fila);
        array_push($datos, $jugador);
    }

    return $datos;
}

private static function jugadorCrearDesdeRs(array $fila): Jugador
{
    return new Jugador($fila["id"], $fila["nombre"], $fila["verssion"], $fila["goles"], $fila["asistencias"], $fila["id"]);
}

public static function jugadorEliminarPorId(int $id): bool
    {
        $sql = "DELETE FROM jugador WHERE id=?";
        $return = DAO::ejecutarConsultaActualizar($sql, [$id]);
        if ($return) {
            return true;
        } else {
            return false;
        }
    }

    public static function jugadorCrear($nombre, $verssion, $goles, $asistencias, $id): bool
    {
        $sql = "INSERT INTO jugador (nombre,verssion,goles,asistencias,id) VALUES (?,?,?,?,?)";
        $parametros = [$nombre, $verssion, $goles, $asistencias, $id];
        $datos = DAO::ejecutarConsultaActualizar($sql, $parametros);
        return $datos;
    }

    public static function jugadorModificar($nombre, $verssion, $goles, $asistencias, $idPosicion, $idEquipo): bool
    {
        $sql = "UPDATE jugador SET nombre=?,verssion=?,goles=?,asistencias=?,id=? WHERE id=?";
        $parametros = [$nombre, $verssion, $goles, $asistencias, $idPosicion, $idEquipo];
        return $datosNoModificados = DAO::ejecutarConsultaActualizar($sql, $parametros);
    }

    public static function jugadorObtenerPosicion(int $id): string
    {
        $rs = self::ejecutarConsultaObtener(
            "SELECT nombre FROM posicion WHERE id=?",
            [$id]
        );
        return $rs[0]["nombre"];
    }

    public static function muestraJugadores($id)
    {
        return $rs = self::ejecutarConsultaMostrar(
            "SELECT * FROM jugador WHERE id=? ORDER BY nombre",
            [$id]
        );
    }

    public static function muestraJugadoresEquipo($id)
    {
        return   $rs = self::ejecutarConsultaMostrar(
            "SELECT * FROM jugador WHERE id=? ORDER BY nombre",
            [$id]
        );

    }


/* FUNCIONES PARA POSICION*/

public static function posicionCrear($nombre): bool
{
        $sql = "INSERT INTO posicion (nombre) VALUES (?)";
        $parametros = [$nombre];
        $datos = DAO::ejecutarConsultaActualizar($sql, $parametros);
        return $datos;
}

public static function posicionModificar($nombre, $id): bool
{
        $sql = "UPDATE posicion SET nombre=? WHERE id=?";
        $parametros = [$id, $nombre];
        $datos = DAO::ejecutarConsultaActualizar($sql, $parametros);
        return $datos;
}

private static function posicionCrearDesdeRs(array $fila): Posicion
{
     return new Posicion($fila["id"], $fila["nombre"]);
}

public static function posicionObtenerPorId(int $id): ?Posicion
{
        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM posicion WHERE id=?",
            [$id]);
        if ($rs) return self::posicionCrearDesdeRs($rs[0]);
        else return null;
}

public static function posicionObtenerTodos(): array
{
        $datos = [];

        $rs = self::ejecutarConsultaObtener(
            "SELECT * FROM posicion ORDER BY nombre", []);

        foreach ($rs as $fila) {
            $posicion = self::posicionCrearDesdeRs($fila);
            array_push($datos, $posicion);
        }

        return $datos;
    }

    public static function eliminarPosicionPorId(int $id): bool
    {
        $sql = "DELETE FROM posicion WHERE id=?";
        return self::ejecutarConsultaActualizar($sql, [$id]);
    }



    /* FUNCIONES PARA EQUIPO */

    public static function crearEquipo($nombre): bool
    {
        $equipo = self::ejecutarConsultaActualizar("INSERT INTO equipo(nombre) VALUES (?) ", [$nombre]);
        return $equipo;
    }

    private static function crearEquipoDesdeRs(array $fila): Equipo
    {
        return new Equipo($fila["id"], $fila["nombre"]);
    }

    public static function modificarEquipo($nombre, $id): bool
    {
        $equipo = self::ejecutarConsultaActualizar("UPDATE equipo SET nombre=? WHERE id=?;",
            [$id, $nombre]);
        return $equipo;
    }

    public static function obtenerEquipoId(int $id): int
    {
        $rsEquipoId = self::ejecutarConsultaObtener(
            "SELECT * FROM equipo WHERE id=?",
            [$id]);
            if ($rs) return self::crearEquipoDesdeRs($rs[0]);
            else return null;
    }

    public static function obtenerEquipoTodos(): array
    {
        $datos = [];

        $rs = self::ejecutarConsultaObtener(
            "SELECT id, nombre FROM equipo ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::crearEquipoDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    public static function agregarJugadorEquipo(int $id, $id): void
    {
        $equipoId = self::obtenerListadoEquipoId($id);

        self::ejecutarConsultaActualizar(
            "INSERT INTO jugador_equipo (id, id) VALUES (?,?) ",
            [$equipoId, $id]
        );
    }

 /* JUGADOR_EQUIPO */
    public static function equipoEliminar(int $id): ?int
    {
        $resultado = self::ejecutarActualizacion(
            "DELETE FROM equipo WHERE id=?",
            [$id]
        );

        return $resultado;
    }

}