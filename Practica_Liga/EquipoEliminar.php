<?php
require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM equipo WHERE id=?";

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute([$id]);

$unaFilaAfectada = ($sentencia->rowCount() == 1);
$ningunaFilaAfectada = ($sentencia->rowCount() == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($correcto) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el equipo.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no completada</h1>
    <p>No existe el equipo que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el equipo o no existía.</p>

<?php } ?>

<a href='EquipoListado.php'>Volver al listado de equipos.</a>

</body>

</html>