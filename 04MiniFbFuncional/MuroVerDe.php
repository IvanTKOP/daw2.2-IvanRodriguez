<?php

require_once "_com/_Varios.php";
require_once "_com/_DAO.php";

if (!haySesionRamIniciada() && !intentarCanjearSesionCookie()) {
    DAO::redireccionar("SesionInicioFormulario.php");
}

if (isset($_REQUEST["idUsuario"])) {
    $id = (int) $_REQUEST["idUsuario"];
    $usuario = DAO::usuarioObtenerPorId($id);
} else {
    $id = (int) $_REQUEST["id"];
    $usuario = DAO::usuarioObtenerPorId($id);
}

$posibleClausulaWhere = "WHERE destinatarioId LIKE " . $id;
$publicaciones = DAO::publicacionObtenerTodas($posibleClausulaWhere);

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php DAO::pintarInfoSesion();?>

<h1>Muro de <?php echo $usuario->getIdentificador() ?></h1>
<?php echo "<form action='PublicacionNuevaCrear.php?destinatarioId=" . $usuario->getId() . "&ficha=MuroVerDe.php?id=" . $usuario->getId() . "' method='POST'>" ?>

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
        <th>EmisorId</th>
        <th>DestinatarioId</th>
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
            <td><?=$publicacion->getFecha()?></td>
            <td><a href="MuroVerDe.php?id=<?=$publicacion->getEmisorId()?>"><?=$emisor->getNombre()?></a></td>
            <?php if ($destinatario != null) {?>
                <td><a href="MuroVerDe.php?id=<?=$destinatario->getId()?>"><?=$destinatario->getNombre()?></a></td>
            <?php } else {?>
                <td><?=$publicacion->getDestinatarioId()?></td>
            <?php }?>
            <td><?=$publicacion->getdestacadaHasta()?></td>
            <td><?=$publicacion->getAsunto()?></td>
            <td><?=$publicacion->getContenido()?></td>
            <?php if ($emisor->getId() == $_SESSION["id"]) {?>
                <td><a href="PublicacionEliminar.php?ficha=MuroVerDe.php&id=<?=$publicacion->getId()?>">X</a></td>
            <?php }?>
        </tr>
    <?php }?>

</table>

<a href='Index.php'>Ir al Contenido Público 1</a>

<a href='MuroVerGlobal.php'>Ir al Contenido Privado 1</a>

</body>

</html>