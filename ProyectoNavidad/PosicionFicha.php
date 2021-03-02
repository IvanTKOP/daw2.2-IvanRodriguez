<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";

/*
if(!DAO::haySesionIniciada()) {
    redireccionar("SessionInicioFormulario.php");
}*/

$id = (int)$_REQUEST["id"];
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $nombre = "<Introduce posición>";

} else {
   $posicion = DAO::posicionObtenerPorId($id);
   $nombre = $posicion->getnombre();
}


?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1 style="text-align: center">Nueva ficha de posición</h1>
<?php } else { ?>
    <h1 style="text-align: center">Ficha de posición</h1>
<?php } ?>

<form method='post' action='PosicionGuardar.php' style="text-align: center">

    <input type='hidden' name='id' value='<?=$id?>' />

    <strong>Nombre</strong>
    <input type='text' name='nombre' value='<?=$nombre?>' />
    <br/>

    <br/>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear posición' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br />

<p>Jugadores que juegan en la posición:</p>

<ul>
    <?php
    $rsJugadoresDeLaCategoria = DAO::muestraJugadores($id);
    ?>
</ul>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='PosicionEliminar.php?id=<?=$id?>'>Eliminar posición</a>
<?php } ?>

<br />
<br />

<a href='PosiciónListado.php'>Volver al listado de posiciones.</a>

</body>

</html>