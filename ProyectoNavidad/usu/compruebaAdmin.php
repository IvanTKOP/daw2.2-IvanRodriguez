<?php

require_once "../_com/comunes-app.php";

if ($_SESSION["administrador"] == 1) {
    redireccionar("../adm/jugador-listado.php");

} else {
    redireccionar("../usu/jugador-listado.php");
}
