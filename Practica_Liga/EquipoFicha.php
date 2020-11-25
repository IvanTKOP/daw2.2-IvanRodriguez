<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $equipoNombre = "";
    $equipoEntrenador = "";
    $equiporedsocial = "@";
    $equipoEstrella = false;
    $equipoCategoriaId = 0;
} else {
    $sqlEquipo = "SELECT nombre, entrenador, redsocial, estrella, categoriaId FROM equipo WHERE id=?";

    $select = $conexion->prepare($sqlEquipo);
    $select->execute([$id]);
    $rsEquipo = $select->fetchAll();

    $equipoNombre = $rsEquipo[0]["nombre"];
    $equipoEntrenador = $rsEquipo[0]["entrenador"];
    $equiporedsocial = $rsEquipo[0]["redsocial"];
    $equipoEstrella = ($rsEquipo[0]["estrella"] == 1);
    $equipoCategoriaId = $rsEquipo[0]["categoriaId"];
}


$sqlCategorias = "SELECT id, nombre FROM categoria ORDER BY id";

$select = $conexion->prepare($sqlCategorias);
$select->execute([]);
$rsCategorias = $select->fetchAll();

?>




<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de equipo</h1>
<?php } else { ?>
    <h1>Ficha de equipo</h1>
<?php } ?>

<form method='post' action='EquipoGuardar.php'>

    <input type='hidden' name='id' value='<?= $id ?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$equipoNombre ?>' />
        </li>
        <li>
            <strong>Entrenador: </strong>
            <input type='text' name='entrenador' value='<?=$equipoEntrenador ?>' />

        </li>
        <li>
            <strong>Red Social: </strong>
            <input type='text' name='redsocial' value='<?=$equiporedsocial ?>' />
        </li>
        <li>
            <strong>Categoría: </strong>
            <select name='categoriaId'>
                <?php
                foreach ($rsCategorias as $filaCategoria) {
                    $categoriaId = (int) $filaCategoria["id"];
                    $categoriaNombre = $filaCategoria["nombre"];

                    if ($categoriaId == $equipoCategoriaId) $seleccion = "selected='true'";
                    else                                     $seleccion = "";

                    echo "<option value='$categoriaId' $seleccion>$categoriaNombre</option>";

                   }
                ?>
            </select>
        </li>
        <li>
            <strong>Favorito</strong>
            <input type='checkbox' name='estrella' <?=$equipoEstrella ? "checked" : "" ?>
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear equipo' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='EquipoEliminar.php?id=<?=$id ?>'>Eliminar equipo</a>
<?php } ?>

<br />
<br />

<a href='EquipoListado.php'>Volver al listado de equipos.</a>

</body>

</html>