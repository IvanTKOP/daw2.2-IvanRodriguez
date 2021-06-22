<?php

require_once "_com/DAO.php";
require "_com/PintarSesion.php";

$id = $_SESSION["id"];

$usuario = DAO::usuarioObtenerPorId($id);

?>



<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="css/Estilos.css" />
    <title>Mi Cuenta</title>
</head>


<body>
<h1 style="text-align: center">Mi Cuenta</h1>
<div class="div1">
    <p>Nombre: <?=$usuario->getNombre()?></p>
    <p>Apellidos: <?=$usuario->getApellidos()?></p>
    <p>Usuario: <?=$usuario->getUsuario()?></p>

<br>

<a href="usuario-baja-confirmar.php" class="boton">Eliminar Cuenta</a>

<a href="paginaprincipal.php" class="boton">Volver a la Página Principal</a>

</div>

</body>

</html>