<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
require_once "_com/_Sesion.php";

if(!DAO::haySesionIniciada()){
    redireccionar("SessionInicioFormulario.php");
}

$posiciones = DAO::posicionObtenerTodos();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1 style="text-align: center">Listado de Posiciones</h1>

<table border='1' style="margin: 0 auto">

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($posiciones as $posicion) { ?>
        <tr>
            <td style="text-align: center;"><a href='PosicionFicha.php?id=<?=$posicion->getId()?>'> <?=$posicion->getnombre()?> </a></td>
            <td style="text-align: center;"><a href='PosicionEliminar.php?id=<?=$fila->getId()?>'> (X)                            </a></td>
        </tr>
    <?php } ?>

</table>

<br/>

<a href='PosicionFicha.php?id=-1'>Crear nueva posición</a>

<br />
<br />

<a href='EquipoListado.php'>Gestionar mi equipo</a>

<br />
<br />

<a href='JugadorListado.php'>Volver al listado de jugadores</a>
</body>

</html>