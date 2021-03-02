<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
require_once "_com/_Sesion.php";

$id= (int)$_REQUEST["id"];
$resultado = DAO::eliminarPosicionPorId($id);

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($resultado) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la posición.</p>

<?php } else { ?>

    <h1>Error al eliminar la posición</h1>
    <p>No se ha podido eliminar la posición.</p>

<?php } ?>

<a href='PosicionListado.php'>Volver al listado de posiciones</a>

</body>

</html>
