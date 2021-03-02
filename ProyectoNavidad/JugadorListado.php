<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
require_once "_com/_Sesion.php";

$jugadores = DAO::jugadorObtenerTodos();

?>

<html>

<head>
    <meta charset='UTF-8'>
    <title>Listado de Jugadores</title>
</head>

<body>

<h1 style="text-align: center">Listado de Jugadores</h1>

<table border='1' style="margin: 0 auto">

    <tr>
        <th>Nombre</th>
        <th>Versión</th>
        <th>Posición</th>
        <th>Añadir</th>
    </tr>

    <?php
    foreach ($jugadores as $jugador) { ?>
        <tr>
            <td style="text-align: center;"><a href= "JugadorFicha.php?id=<?=$jugador->getId();?>"> <?= $jugador->getnombre();?></a></td>

            <td style="text-align: center;"><?=$jugador ->getVersion();?></td>

            <td style="text-align: center;"><a href= "PosicionFicha.php?id=<?=$jugador->getId();?>"> <?= $jugador->getPosicion();?></a></td>

            <td style="text-align: center;"><a href='gestionEquipo.php?jugadorId=<?=$jugador->getId()?>&agregar=true'>(+)</a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='JugadorFicha.php?id=-1'>Crear jugador</a>
<a href='CategoriaListado.php'>Listado de Categorías</a>

</body>

</html>