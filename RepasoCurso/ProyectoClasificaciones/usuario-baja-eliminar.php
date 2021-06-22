<?php
require_once "_com/DAO.php";

if (isset($_REQUEST["cancelar"])) {
    redireccionar("usuario-detalle.php");
} else {
    DAO::usuarioBorrar();
    DAO::destruirSesionRamYCookie();
    redireccionar("sesion-inicio.php?cuentaBorrada");

}
