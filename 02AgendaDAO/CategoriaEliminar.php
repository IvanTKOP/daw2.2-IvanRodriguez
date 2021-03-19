<?php
require_once "_com/_DAO.php";

$id = (int) $_REQUEST["id"];

$correcto = DAO::eliminarCategoriaPorId($id);

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($correcto) {?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la categoría.</p>

<?php } else {?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la categoría.</p>

<?php }?>

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>