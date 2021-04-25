<?php
$vieneOculto = true;

if (isset($_REQUEST["noOculto"])) { // CASO RARO: el jugador no envia numero oculto
    $vieneOculto = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adivina Número Cookies</title>
</head>
<body>
    <h1>Juego Adivina Número</h1>
    <?php if (!$vieneOculto) {?>
        <h2>No has escrito nada, inténtalo de nuevo.</h2>
    <?php }?>
    <p>Jugador 1, escribe el número que tendrá que adivinar el jugador 2</p>
    <form method="get" action="adivinaNumeroPrincipal.php">
        <input type="number" name="oculto">
        <input type="submit" value="Empezar juego">
    </form>
</body>
</html>
