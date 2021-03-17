<div style="overflow: hidden;">
<p style="float: left;">
	Hola, <?=$_SESSION["nombre"]?>
    <a href="../usu/sesion-cerrar.php">Cerrar Sesión</a>
</p>
<p style="float: right;">
    <a href='../usu/usuario-detalle.php'>Mi cuenta</a>
    <?php if ($_SESSION["administrador"] == 0) {?>
    <a href="../usu/jugadores-guardados.php">Mi Equipo</a>
    <?php }
?>
</p>
</div>