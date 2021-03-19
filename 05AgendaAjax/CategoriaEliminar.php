<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";

$id = (int) $_REQUEST["id"];
$sqlConExito = dao::categoriaEliminar($id);

$correctoNormal = ($sqlConExito == true);
$noExistia = ($sqlConExito == null);

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($correctoNormal) {?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la categoría.</p>

	<?php } else if ($noExistia) {?>

<h1>Eliminación no realizada</h1>
<p>No existe la categoría que se pretende eliminar (quizá la eliminaron en paraleo o, ¿ha manipulado Vd. el parámetro id?).</p>
<?php } else {?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la categoría.</p>

<?php }?>

<a href='CategoriaObtenerTodas.php'>Volver al listado de categorías.</a>

</body>

</html>