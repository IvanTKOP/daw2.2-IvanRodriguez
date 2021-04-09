<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";

$id = (int) $_REQUEST["id"];
$publicacion = DAO::publicacionFicha($id);
$correcto = DAO::eliminarPublicacionPorId($id);
if ($correcto) {
    $ficha = $_REQUEST["ficha"] . "?eliminacionCorrecta&idUsuario=3";
} else {
    $ficha = $_REQUEST["ficha"] . "?eliminacionErronea";
}
DAO::redireccionar($ficha);
