<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$id = (int) $_REQUEST["id"];
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $categoriaNombre = "<introduzca nombre>";
} else {
    $sql = "SELECT nombre FROM Categoria WHERE id=?";
    $rs = DAO::ejecutarConsulta($sql, $id);
    $categoriaNombre = $rs[0]["nombre"];
}
$sql = "SELECT * FROM Persona WHERE categoriaId=? ORDER BY nombre";
$rsPersonasDeLaCategoria = DAO::ejecutarConsulta($sql, $id);
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) {?>
	<h1>Nueva ficha de categoría</h1>

<?php } else {?>
	<h1>Ficha de categoría</h1>

<?php }?>

<form method='post' action='CategoriaGuardar.php'>

<input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre</label>
	<input type='text' name='nombre' value='<?=$categoriaNombre?>' />
    <br/>
    <br/>

<?php if ($nuevaEntrada) {?>
	<input type='submit' name='crear' value='Crear categoría' />
<?php } else {?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php }?>

</form>

<br/>

<p>Personas que pertenecen actualmente a la categoría:</p>

<ul>
<?php
foreach ($rsPersonasDeLaCategoria as $fila) {
    echo "<li>$fila[nombre] $fila[apellidos]</li>";
}
?>
</ul>

<?php if (!$nuevaEntrada) {?>
    <br />
    <a href='CategoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
<?php }?>

<br />
<br />

<a href='CategoriaObtenerTodas.php'>Volver al listado de categorías.</a>

</body>

</html>