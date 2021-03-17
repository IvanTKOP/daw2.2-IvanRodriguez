<?php
require_once "../_com/comunes-app.php";

if (isset($_REQUEST['borrar'])) {
    DAO::jugadorEliminar();
}

?>


<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

<p>Jugador Borrado con éxito</p><br>
<a href='jugador-listado.php'>Volver a la lista de jugadores</a>
</body>
</html>
