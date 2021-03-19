<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";

$asunto = $_REQUEST["asunto"];
$contenido = $_REQUEST["nuevaPublicacion"];
$fecha = date("Y-m-d H:i:s");

if (isset($_REQUEST["destinatarioId"])) {
    $destinatario = $_REQUEST["destinatarioId"];
} else {
    $destinatario = null;
}
if (isset($_REQUEST["destacadaHasta"])) {
    $destacadaHasta = $_REQUEST["destacadaHasta"];
} else {
    $destacadaHasta = null;
}

DAO::publicacionCrear($fecha, $_SESSION["id"], $destinatario, $destacadaHasta, $asunto, $contenido);
DAO::redireccionar($_REQUEST["ficha"]);
