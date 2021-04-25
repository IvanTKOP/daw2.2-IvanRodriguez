<?php
// VARIABLES GLOBALES

$terminado = false;
$maxIntentos = false;
$vieneIntento = true;

if (isset($_REQUEST["oculto"])) { // Primera vez con el formulario
    $oculto = (int) $_REQUEST["oculto"];
    $intento = null;
    $numIntentos = 0;
} else if (!isset($_COOKIE["oculto"])) { // Querian continuar, pero no hay cookie; no se puede
    header("Location: adivinaNumeroInicio.php?noOculto");
    exit;
} else if (isset($_REQUEST{"intento"})) { // Segunda y siguientes veces con "$intento"
    $oculto = (int) $_COOKIE["oculto"];
    $intento = (int) $_REQUEST["intento"];
    $numIntentos = (int) $_COOKIE["numIntentos"] + 1;
} else { // Querian continuar y es posible porque hay cookie
    $oculto = (int) $_COOKIE["oculto"];
    $intento = null;
    $numIntentos = (int) $_COOKIE["numIntentos"];
}

if ($intento == null) { // Si es la primera vez y...
    if (isset($_REQUEST["intento"])) { // ... si el jugador2 no envia numero de intento
        $vieneIntento = false;
        $numIntentos = $numIntentos - 1; // restamos el intento fallido
    }
}

if ($oculto == null) { // no viene oculto
    header("Location: adivinaNumeroInicio.php?noOculto");
    exit;
}

if ($numIntentos >= 10 && $oculto != $intento) { // CASO RARO: Acertar en el último intento
    $maxIntentos = true;
}

$intentosRestantes = 10 - $numIntentos;

setcookie("oculto", $oculto, time() + 60 * 60);
setcookie("numIntentos", $numIntentos, time() + 60 * 60);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adivina Número Cookies</title>
</head>
<body>
<?php

if ($maxIntentos) {?>
    <h1>Has perdido, se acabaron los intentos.</h1>
<?php $terminado = true;
    $intento = null; // para que no informe nada
}

if ($intento == null) {
    // No informamos de nada, el juego acaba de empezar.
} else if ($intento < $oculto) {?>
            <h2>Casi, prueba un número más alto</h2>
                <?php if (($oculto - $intento) <= 5) {?>
                <h2>Distancia: *</h2>
                <?php } else if (($oculto - $intento) <= 10) {?>
                    <h2>Distancia: **</h2>
                    <?php } else if (($oculto - $intento) > 10) {?>
                    <h2>Distancia: ***</h2>
                    <?php }
} else if ($intento > $oculto) {?>
             <h2>Casi, prueba un número más bajo</h2>
            <?php if (($intento - $oculto) <= 5) {?>
                <h2>Distancia: *</h2>
                <?php } else if (($intento - $oculto) <= 10) {?>
                    <h2>Distancia: **</h2>
                    <?php } else if (($intento - $oculto) > 10) {?>
                    <h2>Distancia: ***</h2>
                    <?php }
} else {?>
    <h2>¡Correcto, has ganado! El número era <?=$oculto?>.</h2>
    <p>Has realizado <?=$numIntentos?> intentos</p>
    <?php $terminado = true;
}

if (!$vieneIntento) {?>
    <h2>No has introducido ningún número, inténtalo de nuevo. (Esto no te cuenta como intento)</h2>
<?php }

if (!$terminado) {?>
    <p>Jugador 2, prueba a adivinar el número, tienes <?=$intentosRestantes?> intentos</p>
    <form method="get"> <!-- Action será el mismo php -->
        <input type="number" name="intento">
        <input type="submit" value="Adivinar">
    </form>
<?php }?>
</body>
</html>