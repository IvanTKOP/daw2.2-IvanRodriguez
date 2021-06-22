<?php
require_once "_com/DAO.php";

if (isset($_REQUEST["usuario"]) && $_REQUEST["usuario"] != "") {
    $usuario = $_REQUEST["usuario"];

    $existeUsuario = DAO::usuarioObtenerPorUsuario($usuario);
    if ($existeUsuario == true) {
        redireccionar("usuario-registro-formulario.php?existe");
    }

    $contrasenna = $_REQUEST["contrasenna"];
    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];

    DAO::usuarioCrear($usuario, $nombre, $apellidos, $contrasenna);

    redireccionar("sesion-inicio.php?registrado");
} else {
    redireccionar("usuario-registro-formulario.php?error");
}
