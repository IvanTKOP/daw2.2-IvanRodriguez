<?php

require_once "../_com/comunes-app.php";

require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 1) {

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
    Versión<select name="verssion" required>
        <option value="Oro">Oro</option>
        <option value="Plata">Plata</option>
        <option value="IF">IF</option>
        <option value="Icono">Icono</option>
    </select><br><br>
    Posición<select name="posicion" required>
        <option value="Portero">Portero</option>
        <option value="Defensa">Defensa</option>
        <option value="Medio">Medio</option>
        <option value="Delantero">Delantero</option>
    </select><br><br>
    Goles<br>
    <input type="number" min="0" name="goles" required><br><br>
    Asistencias<br>
    <input type="number" min="0" name="asistencias"
    required><br><br>
    <input type="submit">
    </form><br>
<a href="jugador-listado.php">Volver a listado de jugadores</a>


</body>
</html>
<?php
} else {
    echo "No posees cuenta de administrador";
}
?>