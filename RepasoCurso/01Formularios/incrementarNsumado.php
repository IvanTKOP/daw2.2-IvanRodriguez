<?php

if (isset($_REQUEST["reiniciar"])) {
    $numeroSumado = 0;
} else {
    if (isset($_REQUEST["numeroSumado"])) {
        $numeroSumado = $_REQUEST["numeroSumado"];
        $incremento = $_REQUEST["incremento"];
        $numeroSumado = $numeroSumado + $incremento;
    }

    if (isset($_REQUEST["numero"])) {
        $numero = $_REQUEST["numero"];
        $incremento = $_REQUEST["incremento"];
        $numeroSumado = $numero + $incremento;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="incrementarNsumado.php" method="get">
        <input type="number" value="<?=$numeroSumado?>" name="numeroSumado">
        <input type="number" value="0" name="incremento">
        <input type="submit" value="Sumar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>