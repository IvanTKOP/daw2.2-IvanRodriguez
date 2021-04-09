<?php

require_once "_DAO.php";
require_once "_Utilidades.php";
require_once "_Clases.php";

/* SESIONES */

function sessionStartSiNoLoEsta()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

function haySesionIniciada()
{
    sessionStartSiNoLoEsta();
    return isset($_SESSION["sesionIniciada"]);
}

function vieneFormularioDeInicioDeSesion()
{
    return isset($_REQUEST['email']);
}

function vieneCookieRecuerdame()
{
    return isset($_COOKIE["email"]);
}

function garantizarSesion()
{
    sessionStartSiNoLoEsta();

    if (haySesionIniciada()) {
        if (vieneCookieRecuerdame()) {
            establecerCookieRecuerdame($_COOKIE["email"], $_COOKIE["codigoCookie"]);
        }
    } else {
        if (vieneFormularioDeInicioDeSesion()) {

            $usuario = DAO::usuarioObtenerPorEmailYContrasenna($_REQUEST['email'], $_REQUEST['contrasenna']);

            if ($usuario) {
                establecerSesion($usuario);

                if (isset($_REQUEST["recuerdame"])) {
                    generarCookieRecuerdame($usuario);
                }
            } else {
                redireccionar("../usu/sesion-inicio.php?incorrecto=true");
            }
        } else if (vieneCookieRecuerdame()) {
            $usuario = DAO::usuarioObtenerPorEmailYCodigoCookie($_COOKIE["email"], $_COOKIE["codigoCookie"]);

            if ($usuario) {
                establecerSesion($usuario);

                generarCookieRecuerdame($usuario);
            } else {
                borrarCookieRecuerdame($usuario->getEmail());

                redireccionar("../usu/sesion-inicio.php");
            }
        } else {
            redireccionar("../usu/sesion-inicio.php");
        }
    }
}

function establecerCookieRecuerdame($email, $codigoCookie)
{
    setcookie("email", $email, time() + 24 * 60 * 60);
    setcookie("codigoCookie", $codigoCookie, time() + 24 * 60 * 60);
}

function generarCookieRecuerdame($usuario)
{

    $codigoCookie = generarCadenaAleatoria(32);
    DAO::usuarioGuardarCodigoCookie($usuario->getEmail(), $codigoCookie);

    establecerCookieRecuerdame($usuario->getEmail(), $codigoCookie);
}

function borrarCookieRecuerdame($email)
{
    DAO::usuarioGuardarCodigoCookie($email, null);

    setcookie("email", "", time() - 3600);
    setcookie("codigoCookie", "", time() - 3600);
}

function establecerSesion($usuario)
{
    $_SESSION["sesionIniciada"] = "";
    $_SESSION["id"] = $usuario->getId();
    $_SESSION["email"] = $usuario->getEmail();
    $_SESSION["nombre"] = $usuario->getNombre();
    $_SESSION["administrador"] = $usuario->getAdministrador();
}

function cerrarSesion($email)
{
    session_destroy();

    borrarCookieRecuerdame($email);
}
