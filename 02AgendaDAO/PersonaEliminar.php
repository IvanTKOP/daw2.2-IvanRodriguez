<?php
require_once "_com/_DAO.php";

$id = (int) $_REQUEST["id"];

$correcto = DAO::eliminarPersonaPorId($id);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($correcto) {?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente la persona.</p>

<?php } else {?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar la persona o la persona no existía.</p>

<?php }?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>