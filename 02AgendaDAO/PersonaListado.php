<?php
require_once "_com/_Varios.php";
require_once "_com/_DAO.php";
if (isset($_REQUEST["soloEstrellas"])) {
    $posibleClausulaWhere = "WHERE estrella=1";
} else if (isset($_REQUEST["sinEstrellas"])) {
    $posibleClausulaWhere = "WHERE estrella=0";
} else {
    $posibleClausulaWhere = "";
}

$personas = DAO::personaObtenerTodas($posibleClausulaWhere);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Listado de Personas</h1>

<table border='1'>

    <tr>
        <th>Persona</th>
        <th>Categoría</th>
    </tr>

    <?php
foreach ($personas as $persona) {?>
        <tr>
        <td><a href="personaFicha.php?id=<?=$persona->getId()?>">
                    <?php if ($persona->getEstrella() == true) {?>
                        <?=$persona->getNombre()?> <a href="personaEstablecerEstadoEstrella.php?id=<?=$persona->getId()?>"><img src="img/EstrellaRellena.png" width="15" height="15"></a>
                    <?php } else {?>
                        <?=$persona->getNombre()?> <a href="personaEstablecerEstadoEstrella.php?id=<?=$persona->getId()?>"><img src="img/EstrellaVacia.png" width="15" height="15"></a>
                    <?php }?>
                </a></td>
            <td><a href= 'CategoriaFicha.php?id=<?=$persona->getCategoriaId()?>'> <?=DAO::personaCategoria($persona->getCategoriaId())?> </a></td>
            <td><a href='PersonaEliminar.php?id=<?=$persona->getId()?>'> (X)                      </a></td>
        </tr>
    <?php }?>

</table>

<br />

<?php if (!isset($_SESSION["soloEstrellas"])) {?>
    <a href='PersonaListado.php?soloEstrellas'>Mostrar solo contactos con estrella</a>
<?php } else {?>
    <a href='PersonaListado.php?todos'>Mostrar todos los contactos</a>
<?php }?>

<br/>
<br/>

<a href='PersonaFicha.php?id=-1'>Crear entrada</a>

<br/>
<br/>

<a href='CategoriaListado.php'>Gestionar listado de Categorías</a>

</body>

</html>