<?php

require_once "../_com/comunes-app.php";

if ($_SESSION["administrador"] == 1) {

    $id = $_REQUEST["jugadorId"];
    $jugador = DAO::jugadorObtenerPorId($id);
    $nuevoNombre = $_REQUEST["nombre"];
    $nuevaVerssion = $_REQUEST["verssion"];
    $nuevaPosicion = $_REQUEST["posicion"];
    $nuevosGoles = $_REQUEST["goles"];
    $nuevasAsistencias = $_REQUEST["asistencias"];

    DAO::jugadorActualizar($id, $nuevoNombre, $nuevaVerssion, $nuevaPosicion, $nuevosGoles, $nuevasAsistencias);
    ?>



    <html>
    <style>
     .div1{
        left: 400px;
        position:relative;
        text-align:center;
        width: 40%;
    }
            .boton {
                font-family: Arial, Helvetica, sans-serif;
                box-shadow:inset 0px -3px 7px 0px #05b4ff;
                background:linear-gradient(to bottom, #0688fa 5%, #2dabf9 100%);
                background-color:#0688fa;
                border-radius:3px;
                border:1px solid #0b0e07;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:15px;
                padding:9px 23px;
                text-decoration:none;
                text-shadow:0px 1px 0px #263666;
                }
            .boton:hover {
                background:linear-gradient(to bottom, #0088cc 5%, #0062b8 100%);
                background-color:#0088cc;
            }
</style>
    <body>
    <h3 style="text-align: center">Se ha actualizado correctamente el jugador</h3>
    <div class="div1">
        <a href='jugador-listado.php' class="boton">Volver a la lista de jugadores</a>
    </div>
    </body>
    </html>
<?php
} else {
    echo "No posees cuenta de administrador";
}
?>

