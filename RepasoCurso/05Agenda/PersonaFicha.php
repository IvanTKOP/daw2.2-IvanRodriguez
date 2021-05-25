<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int) $_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $personaNombre = "<introduce nombre>";
    $personaApellidos = "<introduce apellidos>";
    $personaTelefono = "<introduce teléfono>";
    $personaCategoriaId = 0;

} else {

    $sql = "SELECT nombre, apellidos, telefono, categoriaId FROM Persona WHERE id=?";

    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([$id]); // IMPORTANTE LOS []
    $rs = $sentencia->fetchAll();

    $personaNombre = $rs[0]["nombre"];
    $personaApellidos = $rs[0]["apellidos"];
    $personaTelefono = $rs[0]["telefono"];
    $personaCategoriaId = $rs[0]["categoriaId"];

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona Ficha</title>
</head>
<body>
    <?php if ($nuevaEntrada) {?>
        <h1>Nueva Ficha de Persona</h1>
    <?php } else {?>
        <h1>Ficha de Persona</h1>
    <?php }?>

    <form method="get" action="PersonaGuardar.php">

    <input type='hidden' name='id' value='<?=$id?>'>

        <ul>
        <?php if ($nuevaEntrada) {?>

            <li> Nombre: <input type="text" name="nombre"  placeholder="<introduce el nombre>"> </li>
            <li> Apellidos: <input type="text" name="apellidos" placeholder="<introduce los apellidos>"> </li>
            <li> Teléfono: <input type="text" name="telefono" placeholder="<introduce el telefono>"> </li>
            <li> Categoría: <input type="text" name="categoria" placeholder="<introduce la categoría>"> </li>

            <?php } else {?>

            <li> Nombre: <input type="text" name="nombre"  value='<?=$personaNombre?>'> </li>
            <li> Apellidos: <input type="text" name="apellidos" value='<?=$personaApellidos?>'> </li>
            <li> Teléfono: <input type="text" name="telefono" value='<?=$personaTelefono?>'> </li>
            <li> Categoría: <input type="text" name="categoria" value='<?=$personaCategoriaId?>'></li>

            <?php }?>
        </ul>

    <?php if ($nuevaEntrada) {?>
        <input type="submit" name="crear" value="Crear Persona">
    <?php } else {?>
        <input type="submit" name="guardar" value="Guardar Cambios">
        <br>
        <br>
        <a href='PersonaEliminar.php?id=<?=$id?>'> Eliminar persona </a>
    <?php }?>

    </form>

    <br>

    <a href='PersonaListado.php'> Volver a listado de personas </a>
</body>
</html>
