<?php

require_once "_com/DAO.php";

DAO::destruirSesionRamYCookie();

redireccionar("sesion-inicio.php?sesionCerrada");

?>
