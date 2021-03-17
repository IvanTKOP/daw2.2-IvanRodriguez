<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 0) {
    $id = $_REQUEST["id"];

    $jugador = DAO::jugadorObtenerPorId($id);

    ?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Jugador</title>
</head>
<body>
    <p>Nombre: <?=$jugador->getNombre()?></p>
    <p>Versión: <?=$jugador->getVerssion()?></p>
    <p>Posición: <?=$jugador->getPosicion()?></p>
    <p>Goles: <?=$jugador->getGoles()?></p>
    <p>Asistencias: <?=$jugador->getAsistencias()?></p>
    <br>
    <a href="jugador-listado.php">Volver al listado de jugadores</a>
</body>
</html>
<?php
} else {
    echo "No eres cuenta usuario";
}
?>

