<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$entrenador = $_REQUEST["entrenador"];
$redsocial = $_REQUEST["redsocial"];
$categoriaId = (int)$_REQUEST["categoriaId"];
$estrella = isset($_REQUEST["estrella"]);

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO equipo (nombre, entrenador, redsocial, estrella, categoriaId) VALUES (?, ?, ?, ?, ?)";
    $parametros = [$nombre, $entrenador, $redsocial, $estrella?1:0, $categoriaId];
} else {
    $sql = "UPDATE equipo SET nombre=?, entrenador=?, redsocial=?, estrella=?, categoriaId=? WHERE id=?";
    $parametros = [$nombre, $entrenador, $redsocial, $estrella?1:0, $categoriaId, $id];
}

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute($parametros);

$numFilasAfectadas = $sentencia->rowCount();
$unaFilaAfectada = ($numFilasAfectadas == 1);
$ningunaFilaAfectada = ($numFilasAfectadas == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php

if ($correcto || $datosNoModificados) { ?>

    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del equipo.</p>

    <?php
}
?>

<a href='EquipoListado.php'>Volver al listado de equipos.</a>

</body>

</html>