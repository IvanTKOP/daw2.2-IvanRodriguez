<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

session_start();

if (isset($_REQUEST["soloEstrellas"])) {
    $_SESSION["soloEstrellas"] = true;
}
if (isset($_REQUEST["todos"])) {
    unset($_SESSION["soloEstrellas"]);
}

$posibleClausulaWhere = isset($_SESSION["soloEstrellas"]) ? "WHERE e.estrella=1" : "";

$sql = "
               SELECT
                    e.id        AS eId,
                    e.nombre    AS eNombre,
                    e.estrella  AS eEstrella,
                    c.id        AS cId,
                    c.nombre    AS cNombre
                FROM
                   equipo AS e INNER JOIN categoria AS c
                   ON e.categoriaId = c.id
                $posibleClausulaWhere
                ORDER BY e.nombre
        ";

$select = $conexion->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Equipos</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Categoría</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td>
                <?php
                $urlImagen = $fila["eEstrella"] ? "img/EstrellaRellena.png" : "img/EstrellaVacia.png";
                echo " <a href='EquipoEstadoEstrella.php?id=$fila[eId]'><img src='$urlImagen' width='16' height='16'></a> ";

                echo "<a href='EquipoFicha.php?id=$fila[eId]'>";
                echo "$fila[eNombre]";

                echo "</a>";
                ?>
            </td>
            <td><a href= 'CategoriaFicha.php?id=<?=$fila["cId"]?>'> <?= $fila["cNombre"] ?> </a></td>
            <td><a href='EquipoEliminar.php?id=<?=$fila["eId"]?>'> (X)                      </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<?php if (!isset($_SESSION["soloEstrellas"])) {?>
    <a href='EquipoListado.php?soloEstrellas'>Mostrar solo equipos favoritos</a>
<?php } else { ?>
    <a href='EquipoListado.php?todos'>Mostrar todos los equipos</a>
<?php } ?>

<br />
<br />

<a href='EquipoFicha.php?id=-1'>Crear equipo</a>

<br />
<br />

<a href='CategoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>