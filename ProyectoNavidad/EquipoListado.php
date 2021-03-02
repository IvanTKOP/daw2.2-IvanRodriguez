<?php

require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
require_once "_com/_Sesion.php";

$equipo = DAO::obtenerEquipoTodos();

?>



<html>

<head>
  <meta charset="UTF-8">
  <title>Listado de Equipos</title>
</head>

<body>

<h1 style="text-align: center">Listado de Equipos</h1>

<table border="1" style="margin: 0 auto;">
  <thead>
  <tr>
    <th>Nombre</th>
  </tr>
  </thead>

  <?php foreach ($equipos as $equipo) { ?>
        <tr>
            <td><a href='equipoFicha.php?id=<?=$equipo->getId()?>'> <?=$equipo->getnombre()?> </a></td>
            <td><a href='equipoEliminar.php?id=<?=$equipo->getId()?>'> (X)                            </a></td>
        </tr>
    <?php } ?>


</table>

<br />

<a href='EquipoFicha.php?id=-1'>Crear equipo</a>

<br />
<br />

<a href='JugadorListado.php'>Gestionar listado de Jugadores</a>

<br />
<br />

<a href="PosicionListado.php">Gestionar listado de Posiciones</a>
</body>

</html>