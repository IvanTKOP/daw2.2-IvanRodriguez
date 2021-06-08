<?php

require_once "_com/DAO.php";

$resultado = DAO::ligaObtenerTodas();

echo json_encode($resultado);
