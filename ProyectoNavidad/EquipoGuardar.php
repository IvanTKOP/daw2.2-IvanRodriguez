<?php

require_once "_com/_DAO.php";
require_once "_com/_Varios.php";

$id= (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];


$nuevaEntrada = ($id == -1);
$resultado=false;
$datosNoModificados=false;

if ($nuevaEntrada){
    $resultado= DAO::crearEquipo($nombre);
    redireccionar("equipoListado.php");
}
else {
    $datosNoModificados = DAO::modificarEquipo($id,$nombre);
    redireccionar("equipoListado.php");
}
?>