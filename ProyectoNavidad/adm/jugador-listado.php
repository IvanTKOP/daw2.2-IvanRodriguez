<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 1) {

    $jugadores = DAO::jugadorObtenerTodos();

    ?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Jugadores Agentes Libres - Admin</title>
</head>

<body>
<h1 style="text-align: center">Listado de Jugadores</h1>

<table border="1" style="margin: 0 auto">

    <tr>
        <th>Nombre</th>
        <th>Versión</th>
        <th>Posición</th>
        <th>Goles</th>
        <th>Asistencias</th>
    </tr>

    <?php foreach ($jugadores as $jugador) {?>
        <tr>
            <td style="text-align: center;">
            <a href= "jugador-detalle.php?id=<?=$jugador->getId();?>"> <?=$jugador->getnombre();?></a></td>

            <td style="text-align: center;">
            <?=$jugador->getVerssion();?></td>

            <td style="text-align: center;">
            <?=$jugador->getPosicion();?></td>

            <td style="text-align: center;">
            <?=$jugador->getGoles();?></td>

            <td style="text-align: center;">
            <?=$jugador->getAsistencias();?></td>

            <td style="text-align: center;"><a href="jugador-detalle.php?id=<?=$jugador->getId()?>">Editar</a></td>
        </tr>
    <?php }?>

</table>

<div style="text-align: center"><a href="jugador-add.php">Añadir nuevo jugador</a></div>

</body>

</html>

<?php
} else {
    echo "No posees cuenta de administrador";
}
?>