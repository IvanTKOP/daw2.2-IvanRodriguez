<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $categoriaNombre = "";
} else {
    $sql = "SELECT nombre FROM categoria WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    $categoriaNombre = $rs[0]["nombre"];
}



$sql = "SELECT * FROM equipo WHERE categoriaId=? ORDER BY nombre";

$select = $conexion->prepare($sql);
$select->execute([$id]);
$rsEquiposDeLaCategoria = $select->fetchAll();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de categoría</h1>
<?php } else { ?>
    <h1>Ficha de categoría</h1>
<?php } ?>

<form method='post' action='CategoriaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Nombre</label>
    <input type='text' name='nombre' value='<?=$categoriaNombre?>' />
    <br/>

    <br/>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear categoría' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br />

<p>Equipos que pertenecen actualmente a la categoría:</p>

<ul>
    <?php
    foreach ($rsEquiposDeLaCategoria as $fila) {
        echo "<li>$fila[nombre]</li>";
    }
    ?>
</ul>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='CategoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
<?php } ?>

<br />
<br />

<a href='CategoriaListado.php'>Volver al listado de categorías.</a>

</body>

</html>