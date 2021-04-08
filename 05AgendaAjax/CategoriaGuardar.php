<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$id = (int) $_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    DAO::categoriaCrear($nombre);
} else {
    DAO::categoriaActualizar($id, $nombre);
}
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($correcto || $datosNoModificados) {?>
	<?php if ($nuevaEntrada) {?>
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
		<?php } else {?>
	<h1>Guardado completado</h1>
	<p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

	<?php if ($datosNoModificados) {?>
				<p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
			<?php }?>
		<?php }
    ?>

<?php
} else {
    ?>

    <?php if ($nuevaEntrada) {?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear la nueva categoría.</p>
<?php } else {?>
	<h1>Error en la modificación.</h1>
	<p>No se han podido guardar los datos de la categoría.</p>
<?php }
}?>

<a href='CategoriaObtenerTodas.php'>Volver al listado de categorías.</a>

</body>

</html>