<?php
	require_once "_Varios.php";

	$conexion = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];
	$nombre = $_REQUEST["nombre"];
	$apellidos = $_REQUEST["apellidos"];
	$telefono = $_REQUEST["telefono"];
    $categoriaId = (int)$_REQUEST["categoriaId"];
    $estrella = isset($_REQUEST["estrella"]);

	$nuevaEntrada = ($id == -1);
	
	if ($nuevaEntrada) {
		// INSERT porque se crea una nueva entrada
 		$sql = "INSERT INTO persona (nombre, apellidos, telefono, estrella, categoriaId) VALUES (?, ?, ?, ?, ?)";
        $parametros = [$nombre, $apellidos, $telefono, $estrella?1:0, $categoriaId];
	} else {
		// UPDATE porque se modifica una ya existente
 		$sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, estrella=?, categoriaId=? WHERE id=?";
        $parametros = [$nombre, $apellidos, $telefono, $estrella?1:0, $categoriaId, $id];
 	}

    $sentencia = $conexion->prepare($sql);
    $sqlConExito = $sentencia->execute($parametros);

    $numFilasAfectadas = $sentencia->rowCount();
    $unaFilaAfectada = ($numFilasAfectadas == 1);
    $ningunaFilaAfectada = ($numFilasAfectadas == 0);

    $correcto = ($sqlConExito && $unaFilaAfectada);

    $datosNoModificados = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php
	if ($correcto || $datosNoModificados) { ?>

		<?php if ($id == -1) { ?>
			<h1>Inserción completada</h1>
			<p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
		<?php } else { ?>
			<h1>Guardado completado</h1>
			<p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

			<?php if ($datosNoModificados) { ?>
				<p>En realidad, no había modificado nada.</p>
			<?php } ?>
		<?php }
?>

<?php
	} else {
?>

	<h1>Error en la modificación.</h1>
	<p>No se han podido guardar los datos de la persona.</p>

<?php
	}
?>

<a href='PersonaListado.php'>Volver al listado de personas.</a>

</body>

</html>