<?php

require_once "_com/DAO.php";

$resultado = DAO::ligaObtenerTodas();

?>



<html>

<head>
    <meta charset='UTF-8' />
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="css/Estilos.css">
    <script src='js/Scripts.js'></script>
    <title>Ligas</title>
</head>

<body>



<h1 style="text-align: center;">Ligas</h1>


<br><br>



<h2>Ligas</h2>

<div id="ligasTabla">
    <div id='ligasCabecera'>
        <div>
            <div>Nombre</div>
            <div>Eliminar</div>
        </div>
    </div>
    <div id='ligasDatos'>
    </div>
</div>

<br>

<input type='text' id='ligaNombre' placeholder='Liga' value='' />
<button id='btnLigaCrear'>Crear liga</button>



<br><br>



<h2>Equipos</h2>

<div id="equiposTabla">
    <div id='equiposCabecera'>
        <div>
            <div>Nombre</div>
            <div>Puntos</div>
            <div>LigaId</div>
            <div>Eliminar</div>
        </div>
    </div>
    <div id='equiposDatos'>
    </div>
</div>

<br>

<input type='text' id='equipoNombre' placeholder='Nombre' value='' />
<input type='text' id='equipoPuntos' placeholder='Puntos' value='' />
<select name='equipoLigaId'>
    <?php
foreach ($resultado as $filaLiga) {
    $ligaId = (int) $filaLiga["id"];
    $ligaNombre = $filaLiga["nombre"];

    if ($ligaId == $equipoLigaId) {
        $seleccion = "selected='true'";
    } else {
        $seleccion = "";
    }

    echo "<option value='$ligaId' $seleccion>$ligaNombre</option>";

}
?>
</select>
<button id='btnEquipoCrear'>Crear equipo</button>



</body>

</html>