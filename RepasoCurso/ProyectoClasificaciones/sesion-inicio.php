<?
require_once "_com/DAO.php";


if (haySesionIniciada()) redireccionar("ligas.html");

?>



<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="css/Estilos.css" />
    <title>Iniciar Sesión</title>
</head>

<body>
<div class="div1">
<?php
if (isset($_REQUEST["incorrecto"])) {
    echo "<p style='color:red'>Usuario o contraseña incorrectos.</p>";
}
if (isset($_REQUEST["registrado"])) {
    echo "<p style='color:green'>Se ha registrado correctamente. Inicie sesion para acceder a la página.</p>";
}
if (isset($_REQUEST["sesionCerrada"])) {
    echo "<p style='color:blue'>Ha salido correctamente. Su sesión está ahora cerrada.</p>";
}
if (isset($_REQUEST["cuentaBorrada"])) {
    echo "<p style='color:green'>La cuenta se borró correctamente.</p>";
}
?>

<h1>Iniciar sesión</h1>

<form action="sesion-inicio-comprobar.php" method="POST">
    <label><b>Usuario: </b></label><input type="text" name="usuario" placeholder="Usuario"><br />
    <label><b>Contraseña: </b></label><input type="password" name="contrasenna" placeholder="Contraseña"/>
    <br/><br/>
    <input type="Submit" value="Iniciar sesión" class="boton">
</form>
<a href="usuario-registro-formulario.php" class="button">Registrarme</a>
<br/><br/>
</div>
</body>
</html>