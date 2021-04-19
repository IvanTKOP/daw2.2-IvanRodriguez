<?php
$acumulado = 0; // Apostamos a que acabamos de llegar o piden reiniciar;

// Si ya viene un acumulado *Y* NO nos piden reiniciar, hay que recoger y utilizar el valor que viene.
if (isset($_COOKIE["acumulado"]) && !isset($_REQUEST["reiniciar"])) {
    $acumulado = $_COOKIE["acumulado"];

    if (isset($_REQUEST["sumar"])) { // si viene sumar, sumamos 1
        $acumulado++;
    }
}

// Establecemos la cookie con el valor que haya quedado:
setcookie("acumulado", $acumulado, time() + 60 * 60);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p><?=$acumulado?></p>
    <form action="incrementar1.php" method="get">
        <input type="submit" value="+1" name="sumar">
        <input type="submit" value="Reiniciar" name="reiniciar"> <!--manera menos eficiente -->
        <a href='<?=$_SERVER["PHP_SELF"]?>?reiniciar'>Manera eficiente de reiniciar</a> <!--manera más eficiente -->  <!-- Hacemos lo mismo que submit pero con $_SERVER -->
    </form>
</body>
</html>