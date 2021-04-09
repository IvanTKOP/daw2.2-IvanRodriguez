<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

$id = (int) $_REQUEST["id"];
DAO::personaEstablecerEstadoEstrella($id);

redireccionar("PersonaListado.php");
