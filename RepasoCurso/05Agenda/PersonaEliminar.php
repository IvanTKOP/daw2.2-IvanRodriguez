<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int) $_REQUEST["id"];

$sql = "DELETE FROM Persona WHERE id=?";

$sentencia = $conexion->prepare($sql);
$sqlconExito = $sentencia->execute([$id]); // IMPORTANTE LOS []

$correcto = ($sqlconExito && $sentencia->rowCount() == 1);

$datosNoModificados = ($sqlconExito && $sentencia->rowCount() == 0);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona ELiminar</title>
</head>
<body>
    <?php if ($correcto) {?>
        <h2>Eliminación Completada</h2>
        <p>Se ha eliminado la persona correctamente</p>
    <?php } else if ($datosNoModificados) {?>
        <h2>No se ha completado la eliminación</h2>
        <p>Tal vez no existia la persona seleccionada</p>
    <?php } else {?>
        <h2>Error al eliminar</h2>
        <p>No se ha podido eliminar la persona</p>
    <?php }?>

    <a href='PersonaListado.php'> Volver a listado de personas </a>
</body>
</html>
