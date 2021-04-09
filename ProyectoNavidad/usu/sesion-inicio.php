<?
require_once "../_com/requireonces-comunes.php";

if (haySesionIniciada()) redireccionar("jugador-listado.php");

?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<style>
    .div1{
            left: 400px;
            position:relative;
            text-align:center;
            width: 40%;
            background-color:#E7E7E7;
        }
        .boton {
          font-family: Arial, Helvetica, sans-serif;
          box-shadow:inset 0px -3px 7px 0px #05b4ff;
          background:linear-gradient(to bottom, #0688fa 5%, #2dabf9 100%);
          background-color:#0688fa;
          border-radius:3px;
          border:1px solid #0b0e07;
          display:inline-block;
          cursor:pointer;
          color:#ffffff;
          font-family:Arial;
          font-size:15px;
          padding:9px 23px;
          text-decoration:none;
          text-shadow:0px 1px 0px #263666;
      }
      .boton:hover {
        background:linear-gradient(to bottom, #0088cc 5%, #0062b8 100%);
        background-color:#0088cc;
      }
      .button {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: #EEEEEE;
  color: #333333;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
}
</style>
<body>
<div class="div1">
<?php
if (isset($_REQUEST["incorrecto"])) {
    echo "<p>Usuario o contraseña incorrectos.</p>";
}
if (isset($_REQUEST["correcto"])) {
    echo "<p>Se ha registrado correctamente. Inicie sesion para acceder a la página.</p>";
}
if (isset($_REQUEST["sesionCerrada"])) {
    echo "<p>Ha salido correctamente. Su sesión está ahora cerrada.</p>";
}
?>

<h1>Iniciar sesión</h1>

<form action="compruebaAdmin.php" method="POST">
    <label><b>Email: </b></label><input type="email" name="email" placeholder="Email"><br />
    <label><b>Contraseña: </b></label><input type="password" name="contrasenna" placeholder="Contraseña"/><br />
    <label><b>Recuérdame</b></label><input type="checkbox" name="recuerdame" /><br />
    <br />
    <input type="Submit" value="Iniciar sesión" class="boton">
</form>
<a href="usuario-registro-formulario.php" class="button">Registrarme</a>
</div>
</body>
</html>