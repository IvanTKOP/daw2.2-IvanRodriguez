<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$sql = "SELECT id, nombre FROM categoria ORDER BY id";

$select = $conexion->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Categorías</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='CategoriaFicha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"] ?> </a></td>
            <td><a href='CategoriaEliminar.php?id=<?=$fila["id"]?>'> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br/>

<a href='CategoriaFicha.php?id=-1'>Crear categoría</a>

<br/>
<br/>

<a href='EquipoListado.php'>Gestionar listado de Equipos</a>

</body>

</html>