<?php

require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$id = $_SESSION["id"];
$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];

$_SESSION["identificador"] = $identificador;
$_SESSION["nombre"] = $nombre;
$_SESSION["apellidos"] = $apellidos;

if (!haySesionRamIniciada() || $_SESSION["id"] == -1) {
    $correcto = DAO::usuarioCrear($identificador, $contrasenna, "", "", 0, $nombre, $apellidos);
    DAO::redireccionar("SesionInicioComprobar.php?identificador=" . $identificador . "&contrasenna=" . $contrasenna);
} else {
    $correcto = DAO::usuarioGuardarPorId($id, $identificador, $contrasenna, "", "", 0, $nombre, $apellidos);
}

if ($correcto) {
    DAO::redireccionar("MuroVerGlobal.php");
} else {
    DAO::redireccionar("UsuarioPerfilVer.php?error");
}
