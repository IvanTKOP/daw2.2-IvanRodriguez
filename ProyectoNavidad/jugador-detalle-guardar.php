<?php

require_once "/_com/comunes-app.php";

$id = $_REQUEST["jugadorId"];
$jugador = DAO::jugadorObtenerPorId($id);
$nuevoNombre = $_REQUEST["nombre"];
$nuevaVerssion = $_REQUEST["verssion"];
$nuevaPosicion = $_REQUEST["posicion"];

DAO::jugadorActualizar($id,$nuevoNombre,$nuevaVerssion,$nuevaPosicion);
?>



<html>
<body>
<p>Se ha actualizado correctamente el jugador
</p><br><a href='jugador-listado.php'>Volver a la lista de jugadores</a>
</body>
</html>

