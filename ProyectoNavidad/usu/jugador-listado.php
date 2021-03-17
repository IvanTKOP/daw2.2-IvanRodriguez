<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 0) {

    $jugadores = DAO::jugadorObtenerTodos();

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
        <th>Goles</th>
        <th>Asistencias</th>
        <th>Añadir</th>
    </tr>

<?php foreach ($jugadores as $jugador) {

        $fichado = $jugador->getFichado();
        if ($fichado == 0) {?>

        <tr>
            <td style="text-align: center;">
            <a href= "../usu/jugador-detalle.php?id=<?=$jugador->getId()?>"> <?=$jugador->getNombre();?></a></td>

            <td style="text-align: center;">
            <?=$jugador->getVerssion()?></td>

            <td style="text-align: center;">
            <?=$jugador->getPosicion()?></td>

            <td style="text-align: center;">
            <?=$jugador->getGoles()?></td>

            <td style="text-align: center;">
            <?=$jugador->getAsistencias()?></td>

            <td style="text-align: center;"><a href="gestionar-jugadores-guardados.php?jugadorId=<?=$jugador->getId()?>&agregar=true">(+)</a></td>
        </tr>
        <?php
}
    }
    ?>

</table>

</body>

</html>

<?php
} else {
    echo "No eres cuenta usuario";
}
?>
