<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 0) {
    $id = $_REQUEST["id"];

    $jugador = DAO::jugadorObtenerPorId($id);

    ?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Jugador</title>
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
</style>
<body>
<h1 style="text-align: center">Ficha Jugador</h1>
<div class="div1">
    <p>Nombre: <?=$jugador->getNombre()?></p>
    <p>Versión: <?=$jugador->getVerssion()?></p>
    <p>Posición: <?=$jugador->getPosicion()?></p>
    <p>Goles: <?=$jugador->getGoles()?></p>
    <p>Asistencias: <?=$jugador->getAsistencias()?></p>
    <br>
    <a href="jugador-listado.php" class="boton">Volver al listado de jugadores</a>
</div>
</body>
</html>
<?php
} else {
    echo "No eres cuenta usuario";
}
?>

