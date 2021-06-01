<?php

require_once "_Varios.php";

$arrayUsuario = obtenerUsuarioPorContrasenna($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) { // Si identificador existe y contraseña es correcta.
    establecerSesionRam($arrayUsuario);

    if (isset($_REQUEST["recordar"])) {
        establecerSesionCookie($arrayUsuario);
    }

    redireccionar('ContenidoPrivado1.php');
} else {
    redireccionar('SesionInicioFormulario.php'); // devolvemoa caso especial datos erroneos
}
