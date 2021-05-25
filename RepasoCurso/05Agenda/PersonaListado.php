<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

/*$sql = "SELECT id, nombre, apellidos, telefono, categoriaId FROM Persona ORDER BY id";*/

$sql = "
        SELECT
            p.id        AS pId,
            p.nombre    AS pNombre,
            c.id        AS cId,
            c.nombre    AS cNombre
        FROM
        Persona AS p INNER JOIN Categoria AS c
        ON p.categoriaId = c.id
        ORDER BY p.nombre
";

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
            <th>Categoría</th>
        </tr>
        <?php foreach ($rs as $fila) {?>
            <tr>
                <td><a href='PersonaFicha.php?id=<?=$fila["pId"]?>'> <?=$fila["pNombre"]?> </td>
                <td> <a href='CategoriaFicha.php?id=<?=$fila["cId"]?>'> <?=$fila["cNombre"]?> </td>
                <td><a href='PersonaEliminar.php?id=<?=$fila["pId"]?>'>(X)</td>
            </tr>
        <?php }?>
    </table>
    <br>
    <a href='PersonaFicha.php?id=-1'> Crear Entrada </a> <!-- Se redirige a Ficha ya que luego lo manda a Guardar, no a Guardar directamente -->
    <br>
    <br>
    <a href='CategoriaListado.php'> Gestionar Categorías </a>
</body>
</html>
