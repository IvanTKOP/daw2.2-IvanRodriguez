<?php

require_once "/_com/comunes-app.php";

$id = $_REQUEST["id"];

$jugador = DAO::jugadorObtenerPorId($id);

require "/_com/_Sesion.php";

?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar Jugador</title>
</head>
<body>
    <p>Nombre: <?=$jugador->getNombre()?></p>
    <p>Versión: <?=$jugador->getVerssion()?></p>
    <p>Posición: <?=$jugador->getPosicion()?> €</p>

    <hr>

        <form action="jugador-detalle-guardar.php">
            Realizar cambios en el jugador:
            <input type="text" name="jugadorId" value="<?=$id?>" size="1" readonly><br><br>
            Nuevo nombre:<br> <input type="text" name="nombre"><br><br>
            Nueva versión:<br> <textarea name="verssion" cols="40" rows="5"></textarea><br><br>
            Nuevo posición:<br> <input type="number" name="posicion"><br><br>
            <input type="submit">
        </form>
    <br>
    <a href="jugador-listado.php">Volver al listado de jugadores</a>
</body>
</html>
