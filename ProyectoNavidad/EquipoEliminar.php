<?php

require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";

$id = (int)$_REQUEST["id"];

$resultado = DAO::equipoEliminar($id);

if($resultado)
    redireccionar("EquipoListado.php?eliminacionCorrecta");
else
    redireccionar("EquipoListado.php?eliminacionErronea");
?>

