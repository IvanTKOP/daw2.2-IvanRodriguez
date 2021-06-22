<style>
    #body{
        font-family: Arial, Helvetica, sans-serif;
    }

    .p {
        float: left;
        border:1px solid black;
        padding: 4px;
        background-color: #E7E7E7;
        border-radius:3px;
    }

    .div {
        overflow: hidden;
        width: 90%;
        left: 60px;
        position:relative;
    }
</style>
<?php if (DAO::haySesionRamIniciada()) { ?>
    <div class="div">
    <p class="p">
        Hola, <?=$_SESSION["nombre"]?> <?=$_SESSION["apellidos"]?>
    </p>

    <p class="p">
        <a href="sesion-cerrar.php"><img src="img/cerrarsesion.png" height="17" width="17" title='Cerrar Sesión'></a>
    </p>

    <p class="p" style="float: right;">
        <a href='usuario-detalle.php'><img src="img/perfil.png" height="40" width="40" title="Mi cuenta"></a>
    </p>
    </div>
<?php } else { // POR SI ACASO
    ?> 
    <div class="div">
    <p class="p">
        <a href="sesion-inicio.php">Iniciar Sesión</a>
    </p>
</div>
<?php 
}
?>