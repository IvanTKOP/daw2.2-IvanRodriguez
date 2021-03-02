<?php

require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) { 

    $nombre = "<introduce nombre>";

} else {
    $equipo= dao::EquipoObtenerPorId($id);
    $nombre = $equipo->getnombre();
}


?>




<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nuevo equipo</h1>
<?php } else { ?>
    <h1>Ficha equipo</h1>
<?php } ?>

<form method='post' action='EquipoGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />


    <strong>Nombre: </strong>
    <input type='text' name='nombre' value='<?=$nombre?>' />
    <br/>

    <br/>

    <br/>


    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear equipo' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>


<p>Jugadores que pertenecen actualmente :</p>

<?php
$rsJugadoresPosicion = DAO::muestraJugadoresEquipo($id);
?>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='EquipoEliminar.php?id=<?=$id?>'>Eliminar equipo</a>
<?php } ?>

<br />
<br />

<a href='EquipoListado.php'>Volver al listado de equipos</a>

</body>

</html>