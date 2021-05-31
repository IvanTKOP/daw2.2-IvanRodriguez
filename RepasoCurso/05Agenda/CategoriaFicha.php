<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD(); // retorna objeto conexion para utilizarlo

// recogemos "id" de la request.
$id = (int) $_REQUEST["id"];

// Si id = -1 quieren CREAR una nueva entrada ($nuevaEntrada tomará true).
// Si id  != -1 quieren VER la ficha de una categoría existente ($nuevaEntrada tomará false).
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que NO se cargan datos.
    $categoriaNombre = "<introduzca el nombre>";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos SI se cargan.
    $sql = "SELECT nombre FROM Categoria WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]); //Se añade parametro a la consulta (El valor "?")
    $rs = $select->fetchAll();

    $categoriaNombre = $rs[0]["nombre"]; // recogemos el primer array asociativo del array escalar (en este caso el único que viene, por el WHERE de la consulta), del que nos quedamos con el "nombre"
}
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ficha Categoria</title>
 </head>
 <body>
<?php if ($nuevaEntrada) {?>
    <h1>Nueva Ficha de Categoría</h1>
<?php } else {?>
    <h1>Ficha de Categoria</h1>
<?php }?>

<form method='get' action='CategoriaGuardar.php'>

    <input type="hidden" name='id' value='<?=$id?>'>

    <ul>

    <?php if ($nuevaEntrada) {?>
        <li>
            <strong>Nombre: </strong>
            <input type="text" name='nombre' placeholder="<introduce el nombre>">
        </li>
    <?php } else {?>
        <li>
            <strong>Nombre: </strong>
            <input type="text" name='nombre' value='<?=$categoriaNombre?>'>
        </li>
    <?php }?>

    </ul>

<?php if ($nuevaEntrada) {?>
    <input type='submit' name='crear' value='Crear Categoría'>
<?php } else {?>
    <input type='submit' name='guardar' value='Guardar Cambios'>
    <br>
    <br>
<?php }

if (!$nuevaEntrada) {?>
<a href='CategoriaEliminar.php?id=<?=$id?>'>Eliminar Categoría</a>
<?php }?>
<br>
<br>
<a href="CategoriaListado.php">Volver al listado de categorías</a>

</form>
 </body>
 </html>
