<?php

require_once "../_com/comunes-app.php";

if (isset($_REQUEST['agregar']))
{
    $equipo = DAO::obtenerListadoJugadoresGuardadosParaUsuario($_SESSION["id"]);
    $variacionUnidades=1;
    if ($_REQUEST["variacionUnidades"])
    {
        $variacionUnidades = $_REQUEST["variacionUnidades"];
    }
    if (!$equipo)
    {
        $equipo = DAO::crearListadoJugadoresUsuario($_SESSION["id"]);
    }
    foreach ($equipo->getFichajes() as $fichaje)
    {
        if ($fichaje->getJugadorId() == $_REQUEST['jugadorId'])
        {
            DAO::listadoVariarUnidades($_SESSION["id"], $_REQUEST['jugadorId'], $variacionUnidades);
            redireccionar("jugador-listado.php");
        }
    }
    DAO::agregarJugadorListadoJugadoresGuardados($_SESSION["id"],$_REQUEST['jugadorId'], $variacionUnidades);
    redireccionar("jugador-listado.php");
}

if (isset($_REQUEST['eliminar']))
{
    $equipoId = DAO::listadoVariarUnidades($_SESSION["id"], $_REQUEST["jugadorId"], 0);
    redireccionar("jugadores-guardados.php");
}

