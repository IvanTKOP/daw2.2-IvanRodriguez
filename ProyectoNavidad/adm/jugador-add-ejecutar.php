<?php

require_once "../_com/comunes-app.php";

if ($_SESSION["administrador"] == 1) {

    $nombre = $_REQUEST["nombre"];
    $verssion = $_REQUEST["verssion"];
    $posicion = $_REQUEST["posicion"];
    $goles = $_REQUEST["goles"];
    $asistencias = $_REQUEST["asistencias"];
    $jugador = new Jugador(null, $nombre, $verssion, $posicion, $goles, $asistencias);
    ?>


<html>
<body>
<h2>Jugador añadido correctamente</h2><br>
<a href='jugador-listado.php'>Volver al listado de jugadores</a>
</body>
</html>
<?php
} else {
    echo "No posees cuenta de administrador";
}
?>

