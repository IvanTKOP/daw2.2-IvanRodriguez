<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 1) {

    $id = $_REQUEST["id"];

    $jugador = DAO::jugadorObtenerPorId($id);

    ?>



<!DOCTYPE html>
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
<h1 style="text-align: center">Editar Jugador</h1>
<div class="div1">
    <p>Nombre: <?=$jugador->getNombre()?></p>
    <p>Versión: <?=$jugador->getVerssion()?></p>
    <p>Posición: <?=$jugador->getPosicion()?></p>
    <p>Goles: <?=$jugador->getGoles()?></p>
    <p>Asistencias: <?=$jugador->getAsistencias()?></p>
    <hr>

        <form action="jugador-detalle-guardar.php">
            Realizar cambios en el jugador:
            <input type="hidden" name="jugadorId" value="<?=$id?>" size="1">
            <input type="text" name="jugadorNombre" value="<?=$jugador->getNombre()?>" readonly><br><br>
            Nuevo nombre:<br> <input type="text" name="nombre"><br><br>
            Nueva versión:<br> <select style="text-align: center" name="verssion" required>
                <option value="Oro">Oro</option>
                <option value="Plata">Plata</option>
                <option value="IF">IF</option>
                <option value="Icono">Icono</option>
            </select><br><br>
            Nuevo posición:<br> <select style="text-align: center" name="posicion" required>
                <option value="Portero">Portero</option>
                <option value="Defensa">Defensa</option>
                <option value="Medio">Medio</option>
                <option value="Delantero">Delantero</option>
            </select><br><br>
            Nuevo número de goles:<br> <input type="number" name="goles" min="0"><br><br>
            Nuevo número de asistencias:<br> <input type="number" name="asistencias" min="0"><br><br>
            <input type="submit">
        </form>
    <br>
    <a href="jugador-borrar.php?id=<?=$jugador->getId()?>&borrar=true" class="boton">Borrar Jugador</a>
    <a href="jugador-listado.php" class="boton">Volver al listado de jugadores</a>
</div>
</body>
</html>

<?php
} else {
    echo "No posees cuenta de administrador";
}
?>
