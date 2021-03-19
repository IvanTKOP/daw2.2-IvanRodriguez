<?php
require_once "../_com/comunes-app.php";

if (isset($_REQUEST["cancelar"])) {
    redireccionar("usuario-detalle.php");
} else {
    $equipo = DAO::obtenerListadoJugadoresGuardadosParaUsuario($_SESSION["id"]);
    foreach ($equipo->getFichajes() as $fichaje) {
        DAO::cambiarFichado($fichaje->getJugadorId(), 0); //libera los jugadores de su equipo al mercado
    }
    cerrarSesion($_SESSION["email"]);
    DAO::usuarioBorrar();
    redireccionar("sesion-inicio.php");

}
