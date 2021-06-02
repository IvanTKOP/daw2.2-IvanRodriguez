<?php

require_once "_Varios.php";

if (haySesionRamIniciada()) {
    redireccionar('ContenidoPrivado1.php');
}

$datosErroneos = isset($_REQUEST["datosErroneos"]); // llega datos erroneos

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Inicio Sesión</title>
</head>
<body>
    <h1 style="text-align:center;">Iniciar Sesión</h1>
    <?php if ($datosErroneos) {?>
        <p style='color: red; text-align:center;'>No se ha podido iniciar sesión con los datos proporcionados. Inténtelo de nuevo.</p>
   <?php }?>

   <form method='get' action='SesionInicioComprobar.php' style="text-align:center;">
        <label for='identificador'>Usuario</label>
        <input type='text' name='identificador'><br><br>

        <label for='contrasenna'>Contraseña</label>
        <input type='password' name='contrasenna' id='contrasenna'><br><br>

        <label for='recordar'>Recuérdame</label>
        <input type='checkbox' name='recordar' id='recordar'><br><br> <!-- El checkbox en php se manda solo si está marcado, si no lo está no se manda-->

        <input type='submit' value='Iniciar Sesión'>
    </form>

</body>

</html>

   </form>
</body>
</html>
