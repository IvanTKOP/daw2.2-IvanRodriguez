<?php

require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

if (!haySesionRamIniciada() && !intentarCanjearSesionCookie()) {
    DAO::redireccionar("SesionInicioFormulario.php");
}

$posibleClausulaWhere = "";
$publicaciones = DAO::publicacionObtenerTodas($posibleClausulaWhere);

?>


<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php DAO::pintarInfoSesion();?>

<h1>Muro global</h1>

<form action="PublicacionNuevaCrear.php?ficha=MuroVerGlobal.php" method="POST">
    <label>Asunto:</label><br/>
    <input type="text" name="asunto" id="asunto"><br/>
    <label>Destacado Hasta:</label>
    <input type="date" name="destacadaHasta" id="destacadaHasta"><br/>
    <label>Contenido:</label><br/>
    <textarea name="nuevaPublicacion" id="nuevaPublicacion" rows="4" cols="50"></textarea>
    <input type="submit" value="Publicar">
</form>

<table border='1'>

    <tr>
        <th>Id</th>
        <th>Fecha</th>
        <th>Emisor</th>
        <th>Destinatario</th>
        <th>destacadaHasta</th>
        <th>Asunto</th>
        <th>Contenido</th>
        <th>Eliminar</th>
    </tr>

    <?php
foreach ($publicaciones as $publicacion) {?>
        <tr>
            <?php $emisor = DAO::usuarioObtenerPorId($publicacion->getEmisorId());
    if ($publicacion->getDestinatarioId() != null) {
        $destinatario = DAO::usuarioObtenerPorId($publicacion->getDestinatarioId());
    } else {
        $destinatario = null;}?>
            <td><?=$publicacion->getId()?></td>
            <?php if ($publicacion->getdestacadaHasta() != null && $publicacion->getdestacadaHasta() != "0000-00-00 00:00:00") {?>
                <td><b><?=$publicacion->getFecha()?></b></td>
            <?php } else {?>
                <td><?=$publicacion->getFecha()?></td>
            <?php }?>

            <td><a href="MuroVerDe.php?id=<?=$publicacion->getEmisorId()?>"><?=$emisor->getNombre()?></a></td>
            <?php if ($destinatario != null) {?>
                <td><a href="MuroVerDe.php?id=<?=$destinatario->getId()?>"><?=$destinatario->getNombre()?></a></td>
            <?php } else {?>
                <td><?=$publicacion->getDestinatarioId()?></td>
            <?php }?>
            <?php if ($publicacion->getdestacadaHasta() != null && $publicacion->getdestacadaHasta() != "0000-00-00 00:00:00") {?>
                <td><b><?=$publicacion->getdestacadaHasta()?></b></td>
            <?php } else {?>
                <td><?=$publicacion->getdestacadaHasta()?></td>
            <?php }?>

            <?php if ($publicacion->getdestacadaHasta() != null && $publicacion->getdestacadaHasta() != "0000-00-00 00:00:00") {?>
                <td><b><?=$publicacion->getAsunto()?></b></td>
            <?php } else {?>
                <td><?=$publicacion->getAsunto()?></td>
            <?php }?>

            <?php if ($publicacion->getdestacadaHasta() != null && $publicacion->getdestacadaHasta() != "0000-00-00 00:00:00") {?>
                <td><b><?=$publicacion->getContenido()?></b></td>
            <?php } else {?>
                <td><?=$publicacion->getContenido()?></td>
            <?php }?>
            <?php if ($emisor->getId() == $_SESSION["id"]) {?>
                <td><a href="PublicacionEliminar.php?ficha=MuroVerGlobal.php&id=<?=$publicacion->getId()?>">X</a></td>
            <?php }?>
        </tr>
    <?php }?>

</table>

<a href="MuroVerDe.php?id=<?=$_SESSION["id"]?>">Ir a mi muro.</a>

</body>

</html>