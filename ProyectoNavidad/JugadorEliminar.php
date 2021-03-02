<?php
require_once "_com/_DAO.php";
require_once "_com/_Varios.php";
require_once "_com/_Sesion.php";


$id = (int)$_REQUEST["id"];
$correcto= DAO::jugadorEliminarPorId($id) ;

?>


<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

<?php if ($correcto) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el jugador.</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el equipo</p>

<?php } ?>

<a href='JugadorListado.php'>Volver al listado de Jugadores.</a>

</body>

</html>