<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$conexion = obtenerPdoConexionBD();

$id = $_REQUEST["id"];

$sql = "UPDATE Persona SET estrella = (NOT (SELECT estrella FROM Persona WHERE id=?)) WHERE id=?";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([$id, $id]);
redireccionar("PersonaListado.php");
