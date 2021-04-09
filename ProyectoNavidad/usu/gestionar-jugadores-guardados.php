<?php

require_once "../_com/comunes-app.php";

if ($_SESSION["administrador"] == 0) {

    if (isset($_REQUEST['agregar'])) {
        $equipo = DAO::obtenerListadoJugadoresGuardadosParaUsuario($_SESSION["id"]);

        if (!$equipo) {
            $equipo = DAO::crearListadoJugadoresUsuario($_SESSION["id"]);
        }
        foreach ($equipo->getFichajes() as $fichaje) {
            if ($fichaje->getJugadorId() == $_REQUEST['jugadorId']) { //para evitar duplicados
                redireccionar("jugador-listado.php");
            }
        }
        DAO::agregarJugadorListadoJugadoresGuardados($_SESSION["id"], $_REQUEST['jugadorId']);
        redireccionar("jugador-listado.php");
    }

    if (isset($_REQUEST['eliminar'])) {
        DAO::cambiarFichado($_REQUEST['jugadorId'], 0);
        $equipoId = DAO::obtenerListadoJugadoresGuardadosId($_SESSION["id"]);
        DAO::fichajeEliminar($equipoId, $_REQUEST['jugadorId']);
        redireccionar("jugadores-guardados.php");
    }

} else {
    echo "No eres cuenta usuario";
}
