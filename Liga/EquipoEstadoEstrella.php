<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = $_REQUEST["id"];

$sql = "UPDATE equipo SET estrella = (NOT (SELECT estrella FROM equipo WHERE id=?)) WHERE id=?";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([$id, $id]);

redireccionar("EquipoListado.php");
