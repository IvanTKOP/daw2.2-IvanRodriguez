<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$sql = "SELECT id, nombre, apellidos, telefono, categoriaId FROM Persona ORDER BY id";

$select = $conexion->prepare($sql);
$select->execute();
$rs = $select->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona Listado</title>
</head>
<body>
    <h1>Listado de Personas</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
        </tr>
        <?php foreach ($rs as $fila) {?>
            <tr>
                <td><a href='PersonaFicha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"]?> </td>
                <td> <a href='PersonaFicha.php?id=<?=$fila["id"]?>'> <?=$fila["apellidos"]?> </td>
                <td> <?=$fila["telefono"]?> </td>
                <td><a href='PersonaEliminar.php?id=<?=$fila["id"]?>'>(X)</td>
            </tr>
        <?php }?>
    </table>
    <br>
    <a href='PersonaGuardar.php?id=-1'> Crear Entrada </a>
    <br>
    <a href='CategoriaListado.php'> Gestionar Categorías </a>
</body>
</html>
