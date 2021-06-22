<?php

require_once "_com/DAO.php";

$arrayUsuario = DAO::obtenerUsuarioPorContrasenna($_REQUEST["usuario"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) { // Si identificador existe y contraseña es correcta.
    DAO::establecerSesionRam($arrayUsuario);

    redireccionar('PaginaPrincipal.php');
} else {
    redireccionar('sesion-inicio.php?incorrecto'); // devolvemoa caso especial datos erroneos
}
