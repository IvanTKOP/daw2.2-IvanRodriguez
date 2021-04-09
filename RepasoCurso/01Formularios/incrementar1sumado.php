<?php 

if(acaba de empezar || isset($_REQUEST["reiniciar"])) { //hacer reiniciarEficiente bien
    $numeroSumado = 0;
}
if (isset($_REQUEST["numeroSumado"])) {
    $numeroSumado = $_REQUEST["numeroSumado"];
    $numeroSumado = $numeroSumado + 1; 
}

if (isset($_REQUEST["numero"])) {
    $numero = $_REQUEST["numero"];
    $numeroSumado = $numero + 1;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="incrementar1sumado.php" method="get">
        <input type="number" value="<?=$numeroSumado?>" name="numeroSumado">
        <input type="submit" value="Enviar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>