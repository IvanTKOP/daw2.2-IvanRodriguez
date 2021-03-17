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
<div class="div">
<p class="p">
	Hola, <?=$_SESSION["nombre"]?>
    <a href="../usu/sesion-cerrar.php"><img src="../_img/cerrarsesion.png" height="17" width="17" title='Cerrar Sesión'></a>
</p>
<p style="float: right;">
    <a href='../usu/usuario-detalle.php'><img src="../_img/perfil.png" height="50" width="50" title="Mi cuenta"></a>
    <?php if ($_SESSION["administrador"] == 0) {?>
    <a href="../usu/jugadores-guardados.php"><img src="../_img/equipo.png" height="50" width="50" title='Mi Equipo'></a><br>

    <?php }
?>
</p>
</div>