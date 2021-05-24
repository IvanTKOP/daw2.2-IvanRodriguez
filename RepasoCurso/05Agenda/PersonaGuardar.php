<?php

require_once "_Varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int) $_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$categoriaId = (int) $_REQUEST["categoriaId"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $sql = "INSERT INTO Persona (nombre, apellidos, telefono, categoriaId) VALUES (?,?,?,?)";
    $parametros = [$nombre, $apellidos, $telefono, $categoriaId];
} else {
    $sql = "UPDATE Persona SET nombre=?, apellidos=?, telefono=?, categoriaId=? WHERE id=?";
    $parametros = [$nombre, $apellidos, $telefono, $categoriaId, $id];
}

$sentencia = $conexion->prepare($sql);
$sqlConExito = $sentencia->execute($parametros); //Se añaden los parametros ya definidos anteriormente

// Está todo correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona Guardar</title>
</head>
<body>
<?php if ($correcto || $datosNoModificados) {
    if ($nuevaEntrada) {?>
                <h1>Inserción Completada</h1>
                <p>Has creado la persona <?php echo $nombre; ?> correctamente</p>
        <?php } else {?>
                <h1>Guardado Completado</h1>
                <p>Has guardado correctamente los datos de <?php echo $nombre; ?> </p>
        <?php }
    if ($datosNoModificados) {?>
            <p>En realidad, no había modificado nada </p>
        <?php }
} else {?>
        <h1>Error en la modificación </h1>
        <p>No se han podido guardar los datos de persona</p>
    <?php }?>

    <a href='PersonaListado.php'>Volver al listado de personas</a>

</body>
</html>