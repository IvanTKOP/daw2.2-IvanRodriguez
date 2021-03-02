<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
require_once "_com/_Sesion.php";

if(!DAO::haySesionIniciada()){
    redireccionar("SesionInicioFormulario.php");
}

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nuevaEntrada = ($id == -1);
$resultado= false;
$datosNoModificados=false;

if ($nuevaEntrada) {
    $resultado = DAO::posicionCrear($nombre);
} else {
    $datosNoModificados= DAO::posicionModificar($id, $nombre);
}

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php

if ($resultado || $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

        <?php if ($datosNoModificados) { ?>
            <p>En realidad, no había modificado nada</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva posición.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos de la posición <?= $nombre?></p>
    <?php } ?>

    <?php
}
?>

<a href='PosicionListado.php'>Volver al listado de posiciones.</a>

</body>

</html>