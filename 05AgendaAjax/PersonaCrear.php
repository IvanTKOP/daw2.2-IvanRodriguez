<?php
require_once "_com/_DAO.php";

$persona = DAO::personaCrear($_REQUEST["nombre"], $_REQUEST["apellidos"], $_REQUEST["telefono"], $_REQUEST["estrella"], $_REQUEST["categoriaId"]);

echo json_encode($persona);
