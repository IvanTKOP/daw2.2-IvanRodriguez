<?php
require_once "_Varios.php";

if (haySesionRamIniciada()) {
    redireccionar("ContenidoPrivado1.php");
}

$datosErroneos = isset($_REQUEST["datosErroneos"]); // llega caso datos erroneos
?>



<html>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Inicio Sesión</title>
</head>



<body>

<h1>Iniciar sesión</h1>

<?php if ($datosErroneos) {?>
    <p style='color: red;'>No se ha podido iniciar sesión con los datos proporcionados. Inténtelo de nuevo.</p>
<?php }?>

<form action='SesionInicioComprobar.php' method="get">
    <label for='identificador'>Identificador</label>
    <input type='text' name='identificador'><br><br>

    <label for='contrasenna'>Contraseña</label>
    <input type='password' name='contrasenna' id='contrasenna'><br><br>

    <input type='submit' value='Iniciar Sesión'>
</form>

</body>

</html>