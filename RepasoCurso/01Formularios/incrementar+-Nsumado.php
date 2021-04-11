<?php

if (isset($_REQUEST["reiniciar"]) || isset($_REQUEST["reiniciarEficiente"])) { //como hacer con reiniciarEficiente
    $numeroSumado = 0;
} else {
    if (isset($_REQUEST["numeroSumado"])) {
        $numeroSumado = $_REQUEST["numeroSumado"];
        $incremento = $_REQUEST["incremento"];
        if (isset($_REQUEST["sumar"])) {
            $numeroSumado = $numeroSumado + $incremento;
        }
        if (isset($_REQUEST["restar"])) {
            $numeroSumado = $numeroSumado - $incremento;
        }
    }

    if (isset($_REQUEST["numero"])) {
        $numero = $_REQUEST["numero"];
        $incremento = $_REQUEST["incremento"];
        if (isset($_REQUEST["sumar"])) {
            $numeroSumado = $numero + $incremento;
        }
        if (isset($_REQUEST["restar"])) {
            $numeroSumado = $numero - $incremento;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="incrementar+-Nsumado.php" method="get">
        <h1><?=$numeroSumado?></h1>
        <input type="hidden" value="<?=$numeroSumado?>" name="numeroSumado">
        <input type="number" value="0" name="incremento">
        <input type="submit" value="Sumar" name="sumar">
        <input type="submit" value="Restar" name="restar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>" type="submit" name="reiniciarEficiente">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>