<?php

if (isset($_REQUEST["numeroOculto"])) {
    $numeroOculto = $_REQUEST["numeroOculto"];
}

if (isset($_REQUEST["numeroIntento"])) {
    $numeroIntento = $_REQUEST["numeroIntento"];
    $intentos = $_REQUEST["intentos"] + 1;
    if ($intentos == 10 && $numeroIntento != $numeroOculto) { // &&: caso raro de acertar en el último intento
        $terminado = true;
        $maxIntentos = true;
        $numeroIntento = null;
    } else {
        $terminado = false;
        $maxIntentos = false;
    }
} else {
    $numeroIntento = null;
    $intentos = 0;
    $terminado = false;
    $maxIntentos = false;
}

$intentosRestantes = 10 - $intentos;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adivina Número</title>
</head>
<body>
<?php
if ($numeroIntento != null) {
    if ($numeroIntento == $numeroOculto) {?>
            <h2>¡Correcto, has ganado!</h2>
            <p>Has realizado <?=$intentos?> intentos</p>
            <?php $terminado = true;
    }
    if ($numeroIntento > $numeroOculto) {?>
                <h2>Casi, prueba un número más bajo</h2>
            <?php if (($numeroIntento - $numeroOculto) <= 5) {?>
                <h2>Distancia: *</h2>
                <?php } else if (($numeroIntento - $numeroOculto) <= 10) {?>
                    <h2>Distancia: **</h2>
                    <?php } else if (($numeroIntento - $numeroOculto) > 10) {?>
                    <h2>Distancia: ***</h2>
                    <?php }
    }
    if ($numeroIntento < $numeroOculto) {?>
                <h2>Casi, prueba un número más alto</h2>
                <?php if (($numeroOculto - $numeroIntento) <= 5) {?>
                <h2>Distancia: *</h2>
                <?php } else if (($numeroOculto - $numeroIntento) <= 10) {?>
                    <h2>Distancia: **</h2>
                    <?php } else if (($numeroOculto - $numeroIntento) > 10) {?>
                    <h2>Distancia: ***</h2>
                    <?php }
    }
}
if (!$terminado) {?>
    <p>Jugador 2, prueba a adivinar el número, tienes <?=$intentosRestantes?> intentos</p>
    <form method="get"> <!-- Action será el mismo php -->
        <input type="hidden" value="<?=$numeroOculto?>" name="numeroOculto">
        <input type="hidden" value="<?=$intentos?>" name="intentos">
        <input type="number" name="numeroIntento">
        <input type="submit" value="Adivinar">
    </form>
    <?php }

if ($maxIntentos) {?>
    <h1>Has perdido, se acabaron los intentos.</h1>
<?php }
?>
</body>
</html>