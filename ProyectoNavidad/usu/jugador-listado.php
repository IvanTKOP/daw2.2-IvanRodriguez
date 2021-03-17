<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

if ($_SESSION["administrador"] == 0) {

    $jugadores = DAO::jugadorObtenerTodos();

    ?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Jugadores Agentes Libres</title>
</head>

<body>
<style>

      #body{
        font-family: Arial, Helvetica, sans-serif;
      }

      table.general {
        font-family: Arial, Helvetica, sans-serif;
        border: 3px solid #000000;
        background-color: #E7E7E7;
        width: 600px;
        text-align: center;
        border-collapse: collapse;
        margin: 0 auto;
      }
      table.general td, table.general th {
        border: 1px solid #555555;
      }
      table.general tbody td {
        font-size: 13px;
        font-weight: bold;
        color: #000000;
      }
      table.general thead {
        background: #1771E0;
        background: -moz-linear-gradient(top, #5194e8 0%, #2e7fe3 66%, #1771E0 100%);
        background: -webkit-linear-gradient(top, #5194e8 0%, #2e7fe3 66%, #1771E0 100%);
        background: linear-gradient(to bottom, #5194e8 0%, #2e7fe3 66%, #1771E0 100%);
      }
      table.general thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        text-align: center;
        border-left: 1px solid #000102;
      }
      table.general thead th:first-child {
        border-left: none;
      }

      .nombre {
        padding: 10px;
      }

</style>
<h1 style="text-align: center">Listado de Jugadores</h1>

<table class="general">
<thead>
    <tr>
        <th class="nombre">Nombre</th>
        <th>Versión</th>
        <th>Posición</th>
        <th>Goles</th>
        <th>Asistencias</th>
        <th>Añadir</th>
    </tr>
    </thead>
    <tbody>
<?php foreach ($jugadores as $jugador) {

        $fichado = $jugador->getFichado();
        if ($fichado == 0) {?>

        <tr>
            <td>
            <a href= "../usu/jugador-detalle.php?id=<?=$jugador->getId()?>"> <?=$jugador->getNombre();?></a></td>

            <td>
            <?=$jugador->getVerssion()?></td>

            <td>
            <?=$jugador->getPosicion()?></td>

            <td>
            <?=$jugador->getGoles()?></td>

            <td>
            <?=$jugador->getAsistencias()?></td>

            <td><a href="gestionar-jugadores-guardados.php?jugadorId=<?=$jugador->getId()?>&agregar=true"><img src="../_img/annadir.png" height="30" width="30" title='Añadir jugador'></a></td>
        </tr>
        <?php
}
    }
    ?>
</tbody>
</table>

</body>

</html>

<?php
} else {
    echo "No eres cuenta usuario";
}
?>
