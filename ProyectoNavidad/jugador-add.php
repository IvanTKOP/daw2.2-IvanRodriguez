<?php

require_once "/_com/comunes-app.php";

require "/_com/_Sesion.php";

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="jugador-add-ejecutar.php">
    <h2>Añadir nuevo jugador:</h2>
    Nombre<br>
    <input type="text" name="nombre" required><br><br>
    Versión<br>
    <textarea name="verssion" cols="40" rows="5" required></textarea><br><br>
    Posición<br>
    <input type="number" min="0" step="any" name="posicion" required><br><br>
    <input type="submit">
    </form><br>
<a href="jugador-listado.php">Volver a listado de jugadores</a>


</body>
</html>