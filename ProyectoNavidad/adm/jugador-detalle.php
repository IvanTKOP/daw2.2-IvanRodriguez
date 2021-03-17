<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

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
    <hr>

        <form action="jugador-detalle-guardar.php">
            Realizar cambios en el jugador:
            <input type="hidden" name="jugadorId" value="<?=$id?>" size="1">
            <input type="text" name="jugadorNombre" value="<?=$jugador->getNombre()?>" readonly><br><br>
            Nuevo nombre:<br> <input type="text" name="nombre"><br><br>
            Nueva versión:<br> <input  type="text" name="verssion"><br><br>
            Nuevo posición:<br> <input type="text" name="posicion"><br><br>
            Nuevo número de goles:<br> <input type="number" name="goles"><br><br>
            Nuevo número de asistencias:<br> <input type="number" name="asistencias"><br><br>
            <input type="submit">
        </form>
    <br>
    <a href="jugador-borrar.php?id=<?=$jugador->getId()?>&borrar=true">Borrar Jugador</a>
    <a href="jugador-listado.php">Volver al listado de jugadores</a>
</body>
</html>
