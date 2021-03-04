<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);


if ($nuevaEntrada) {
    $nombre = "";
    $verssion = "";
    $goles = 0;
    $asistencias = 0;
    $posicion = "";
    $fichado = 0;

} else {
    $jugador = DAO::jugadorObtenerPorId($id);
    $id = $jugador->getId();
    $nombre = $jugador->getNombre();
    $verssion = $jugador->getVerssion();
    $goles = $jugador->getGoles();
    $asistencias = $jugador->getAsistencias();
    $posicion = $jugador->getPosicion();
    $fichado = $jugador->getFichado();
}
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>
<body>

    <?php if ($nuevaEntrada) { ?>
        <h1>Nueva ficha de jugador</h1>
    <?php } else { ?>
        <h1>Ficha de jugador</h1>
    <?php } ?>

    <form method='post' action='JugadorGuardar.php'>

        <input type='hidden' name='id' value='<?= $id ?>' />

        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' value='<?= $nombre ?>' placeholder="Nombre del Jugador" />
        <br />

        <label for='verssion'> Versión</label>
        <input type='text' name='verssion' value='<?= $verssion ?>' placeholder="Versión del jugador" />
        <br />

        <label for='goles'> Goles</label>
        <input type='text' name='goles' value='<?= $goles ?>' placeholder="Goles Marcados" />
        <br />
        <label for='asistencias'>Asistencias</label>
        <input type='text' name='asistencias' value='<?= $asistencias ?>' placeholder="Asistencias" />
        <br />
        <label for='posicion'>Posición</label>
        <select name='posicion'>
            
            <option value='<?= $posicion ?>'>Portero</option>
            <option value='<?= $posicion ?>'>Defensa</option>
            <option value='<?= $posicion ?>'>Medio</option>
            <option value='<?= $posicion ?>'>Atacante</option>
        </select>

        <br />
        <br />

        <?php if ($nuevaEntrada) { ?>
            <input type='submit' name='crear' value='Crear ficha jugador' />
        <?php } else { ?>
            <input type='submit' name='guardar' value='Guardar cambios' />
        <?php } ?>

    </form>

    <?php if (!$nuevaEntrada) { ?>
        <br />
        <a href='JugadorEliminar.php?id=<?= $id ?>'>Eliminar Jugador</a>
    <?php } ?>

    <br />
    <br />

    <a href='JugadorListado.php'>Volver al listado de jugadores.</a>

</body>

</html>