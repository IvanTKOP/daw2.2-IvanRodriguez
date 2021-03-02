<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";

$id = (int)$_REQUEST["id"];
$nombre = (string)$_REQUEST["nombre"];
$verssion = (string)$_REQUEST["verssion"];
$goles = (int)$_REQUEST["goles"];
$asistencias = (int)$_REQUEST["asistencias"];
$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);
$correcto = "";
$datosNoModificados = "";

if ($nuevaEntrada) {
    $correcto = DAO::jugadorCrear($nombre, $verssion, $goles, $asistencias, $id);
} else {
    $datosNoModificados = DAO::jugadorModificar($nombre, $verssion, $goles, $asistencias, $id, $id);
}

?>




<html>

<head>
    <meta charset='UTF-8'>
</head>
<body>

    <?php
    if ($correcto|| $datosNoModificados) { ?>
        <?php if ($nuevaEntrada) { ?>
            <h1>Inserción completada</h1>
            <p>Se ha insertado correctamente la nueva entrada de <?= $nombre ?>.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos de <?= $nombre ?>.</p>

            <?php if ($datosNoModificados == 0) { ?>
                <p>En realidad, no había modificado nada</p>
            <?php } ?>
        <?php } 
        ?>

    <?php
    } else {
    ?>
        <?php if ($nuevaEntrada) { ?>
            <h1>Error en la creación.</h1>
            <p>No se ha podido crear la nueva entrada.</p>
        <?php } else { ?>
            <h1>Error en la modificación.</h1>
            <p>No se han podido guardar los datos del jugador <?= $nombre ?>.</p>
        <?php } ?>

    <?php
    }
    ?>

    <a href='JugadorListado.php'>Volver al listado de jugadores.</a>

</body>

</html>