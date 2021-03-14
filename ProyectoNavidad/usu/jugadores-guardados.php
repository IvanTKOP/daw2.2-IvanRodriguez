<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

$jugadoresGuardados = DAO::obtenerListadoJugadoresGuardadosParaUsuario($_SESSION["id"]);

?>


<html>

<head>
  <meta charset="UTF-8">
  <title>Mis Jugadores</title>
</head>

<style>
    .boton {
        padding: 4px 25px;
        background: #DCDCDC;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
        font-weight: bold;
    }

    .boton:hover {
        padding: 4px 25px;
        background: #D3D3D3;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
    }

</style>

<body>

<h1 style="text-align: center">Mi Equipo</h1>

<table border="1" style="margin: 0 auto; border-collapse: collapse">
  <thead>
  <tr>
    <th style="width: 148px; padding: 2px; background: #B1A9FF">Nombre</th>
    <th style="width: 775px; padding: 2px; background: #B1A9FF">Versión</th>
    <th style="width: 77px; padding: 2px; background: #B1A9FF">Posición</th>
    <th style="width: 77px; padding: 2px; background: #B1A9FF">Goles</th>
    <th style="width: 77px; padding: 2px; background: #B1A9FF">Asistencias</th>
    <th style="padding: 2px; background: #B1A9FF">Eliminar</th>
  </tr>
  </thead>
  <tbody>

  <?php

  if ($jugadoresGuardados) {
      foreach ($jugadoresGuardados->getFichajes() as $fichaje) {
          $fichaje = DAO::jugadorObtenerPorId($fichaje->getJugadorId());
          ?>
        <tr>
        <td style="padding: 5px; text-align: center; background: #EFEEF1"><a href= "../adm/jugador-detalle.php?id=<?=$fichaje->getId()?>"><?= $fichaje->getNombre();?></a></td>
          <td class="text-center" style="padding: 5px; background: #EFEEF1"><?= $fichaje->getVerssion() ?></td>
          <td class="text-center" style="padding: 5px; text-align: center; background: #EFEEF1"><?= $fichaje->getPosicion() ?></td>
          <td class="text-center" style="padding: 5px; text-align: center; background: #EFEEF1"><?= $fichaje->getGoles() ?></td>
          <td class="text-center" style="padding: 5px; text-align: center; background: #EFEEF1"><?= $fichaje->getAsistencias() ?></td>
          <td class="text-center" style="text-align: center; background: #EFEEF1"><a href="gestionar-jugadores-guardados.php?jugadorId=<?= $fichaje->getId() ?>&eliminar=true">X</a>
          </td>
        </tr>
          <?php
      }
  }
  ?>
  </tbody>
</table>
<br>
<div style="text-align: center"><a href="jugador-listado.php" class="boton">Volver a jugadores libres</a></div>


</body>

</html>