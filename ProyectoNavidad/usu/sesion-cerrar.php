<?php

require_once "../_com/comunes-app.php";

cerrarSesion($_SESSION["email"]);

redireccionar("sesion-inicio.php");

?>
