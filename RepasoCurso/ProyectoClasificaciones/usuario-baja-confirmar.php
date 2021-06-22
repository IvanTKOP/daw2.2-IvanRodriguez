<?php
    require_once "_com/DAO.php";
?>



<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="css/Estilos.css" />
</head>
<body>
<div class="div1">
    <p>¿Seguro que quiere borrar la cuenta <?=$_SESSION["usuario"]?>?</p>
    <form action="usuario-baja-eliminar.php">
        <input class="boton" type="submit" name="cancelar" value="Cancelar">
        <input class="boton" type="submit" name="confirmar" value="Confirmar">
    </form>
</div>

</body>
</html>

