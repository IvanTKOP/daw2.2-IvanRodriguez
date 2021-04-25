<?php
session_start();

$acumulado = 0;
$incremento = 0;

if (!isset($_REQUEST["reiniciar"]) && isset($_SESSION["acumulado"])) {
    $acumulado = $_SESSION["acumulado"];
    if (isset($_REQUEST["incremento"])) {
        $incremento = $_REQUEST["incremento"];
    }
    if (isset($_REQUEST["sumar"])) {
        $acumulado = $acumulado + $incremento;
    }
    if (isset($_REQUEST["restar"])) {
        $acumulado = $acumulado - $incremento;
    }
}

$_SESSION["acumulado"] = $acumulado;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incrementar +-N cookies</title>
</head>
<body>
    <p><?=$acumulado?></p>
    <form method="get">
        <input type="number" value="0" name="incremento">
        <input type="submit" value="Sumar" name="sumar">
        <input type="submit" value="Restar" name="restar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>?reiniciar">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>