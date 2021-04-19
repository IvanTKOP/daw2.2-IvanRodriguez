<?php

$acumulado = 0;
$incremento = 0;

if (!isset($_REQUEST["reiniciar"]) && isset($_REQUEST["acumulado"])) {
    $acumulado = $_REQUEST["acumulado"];
    if (isset($_REQUEST["incremento"])) {
        $incremento = $_REQUEST["incremento"];
    }
    $acumulado = $acumulado + $incremento;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incrementar N</title>
</head>
<body>
    <p><?=$acumulado?></p>
    <form method="get">
        <input type="hidden" value="<?=$acumulado?>" name="acumulado">
        <input type="number" value="0" name="incremento">
        <input type="submit" value="Sumar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>?reiniciar">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>