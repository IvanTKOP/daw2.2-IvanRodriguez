<?php

require_once "../_com/comunes-app.php";
require "../_com/_Sesion.php";

$id = $_SESSION["id"];

$usuario = DAO::usuarioObtenerPorId($id);

?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>
</head>

<style>
    .boton {
        padding: 4px 25px;
        background: #DCDCDC;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
        font-weight: bold;
    }

    .boton:hover {
        padding: 4px 25px;
        background: #D3D3D3;
        border: 1px solid #000000;
        color: #000000;
        border-radius: 4px;
        text-decoration:none;
    }

</style>

<body>
<p>Nombre: <?=$usuario->getUsuario()?></p>
<p>Email: <?=$usuario->getEmail()?></p>

<br>

<a href="usuario-baja-confirmar.php" class="boton">Eliminar Cuenta</a>
<a href="jugador-listado.php" class="boton">Volver al listado de jugadores</a>
</body>

</html>