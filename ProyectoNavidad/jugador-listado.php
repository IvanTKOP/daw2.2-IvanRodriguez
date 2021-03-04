<?php

require_once "/_com/comunes-app.php";

$jugador = DAO::jugadorObtenerTodas();

require "/_com/_Sesion.php";

?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Jugadores Agentes Libres</title>
</head>

<body>
<h1 style="text-align: center">Listado de Jugadores</h1>

<table border="1" style="margin: 0 auto">

    <tr>
        <th>Nombre</th>
        <th>Versión</th>
        <th>Posición</th>
    </tr>

    <?php foreach ($jugadores as $jugador) { ?>
        <tr>
            <td>
                <a ><?=$jugador->getNombre()?></a>
            </td>
            <td>
            </td>
            <td>
                <a href='jugador-detalle.php?id=<?=$jugador->getId()?>'>Modificar</a>
            </td>
        </tr>
    <?php } ?>

</table><br>

<div style="text-align: center"><a href="jugador-add.php">Añadir jugador</a></div>

</body>

</html>