<?php
require_once "../_com/requireonces-comunes.php";

if (isset($_REQUEST["email"]) && $_REQUEST["email"] != "") {
    $email = $_REQUEST["email"];
    $existeEmail = DAO::usuarioObtenerPorEmail($email);
    if ($existeEmail == true) {
        redireccionar("usuario-registro-formulario.php?existe");
    }
    $contrasenna = $_REQUEST["contrasenna"];
    $nombre = $_REQUEST["nombre"];
    $administrador = $_REQUEST["administrador"];
    DAO::usuarioCrear($nombre, $contrasenna, $email, $administrador);
    redireccionar("sesion-inicio.php?registrado");
} else {
    redireccionar("usuario-registro-formulario.php?error");
}
