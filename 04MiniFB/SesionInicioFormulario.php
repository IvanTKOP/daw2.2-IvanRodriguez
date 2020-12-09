<?php
    require_once "_Varios.php";

    if (sesionIniciada()) {
        redireccionar("ContenidoPrivado1.php");
    }

    $errorDatos = isset($_REQUEST["errorDatos"]);
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Iniciar Sesión</h1>

<?php if ($errorDatos) { ?>
    <p>Los datos que ha introducido son erróneos, intente de nuevo.</p>
<?php } ?>

<form method="post" action="SesionInicioComprobar.php">

    <label for="identificador">Usuario: </label>
    <input type="text" name="identificador" id="identificador" /> <br/><br/>

    <label for="contrasenna">Contraseña: </label>
    <input type="password" name="contrasenna" id="contrasenna" /> <br/><br/>

    <input type="submit" name="Enviar" />


</form>

</body>

</html>
