<?php

require_once "_com/DAO.php";

$resultado = DAO::equipoObtenerPorLigaId($_REQUEST["ligaId"]);

echo json_encode($resultado);
