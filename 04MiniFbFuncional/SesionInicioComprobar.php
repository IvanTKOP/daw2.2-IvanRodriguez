<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$arrayUsuario = DAO::obtenerUsuarioPorContrasenna($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) { // Identificador existía y contraseña era correcta.
    establecerSesionRam($arrayUsuario);

    if (isset($_REQUEST["recordar"])) {
        establecerSesionCookie($arrayUsuario);
    }
    $_SESSION["identificador"] = $_REQUEST["identificador"];
    DAO::redireccionar("MuroVerGlobal.php");
} else {
    DAO::redireccionar("SesionInicioFormulario.php?datosErroneos");
}
