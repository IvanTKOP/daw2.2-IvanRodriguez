<?php

require_once "../_com/comunes-app.php";

if ($_SESSION["administrador"] == 1) {

    if (isset($_REQUEST['borrar'])) {
        DAO::jugadorEliminar($_REQUEST["id"]);
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
<?php
} else {
    echo "No posees cuenta de administrador";
}
?>