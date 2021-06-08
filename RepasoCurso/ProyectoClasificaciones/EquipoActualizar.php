<?php

require_once "_com/Clases.php";
require_once "_com/DAO.php";

$equipo = new Equipo($_REQUEST["id"], $_REQUEST["nombre"], $_REQUEST["puntos"], $_REQUEST["ligaId"]);

$equipoNuevo = DAO::equipoActualizar($equipo);

echo json_encode($equipoNuevo);
