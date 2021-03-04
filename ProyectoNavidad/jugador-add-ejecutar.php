<?php

require_once "/_com/comunes-app.php";

$nombre = $_REQUEST["nombre"];
$verssion = $_REQUEST["verssion"];
$posicion = $_REQUEST["posicion"];
$jugador = new Jugador( NULL,$nombre, $verssion, $posicion);
?>


<html>
<body>
<h2>Jugador añadido correctamente</h2><br>
<a href='jugador-listado.php'>Volver al listado de jugadores</a>
</body>
</html>


