<?php
// DUDA : El caso de recargar la pagina y que no sume solo funciona al abrir de nuevo el navegador, una vez sumas un numero y recargas, vuelve a hacerlo

$acumulado = 0;
$incremento = 0;

if (!isset($_REQUEST["reiniciar"]) && isset($_COOKIE["acumulado"])) {
    $acumulado = $_COOKIE["acumulado"];
    if (isset($_REQUEST["incremento"])) { // si existe recogemos, sino es 0
        $incremento = $_REQUEST["incremento"];
    }
    if (isset($_REQUEST["sumar"])) { // si viene sumar, sino solo muestra
        $acumulado = $acumulado + $incremento;
    }
}

setcookie("acumulado", $acumulado, time() + 60 * 60);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Incrementar N cookies</title>
</head>
<body>
    <p><?=$acumulado?></p>
    <form method="get">
        <input type="number" value="0" name="incremento">
        <input type="submit" value="Sumar" name="sumar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href="<?=$_SERVER["PHP_SELF"]?>?reiniciar">Manera eficiente de reiniciar</a> <!--manera más eficiente -->
    </form>
</body>
</html>