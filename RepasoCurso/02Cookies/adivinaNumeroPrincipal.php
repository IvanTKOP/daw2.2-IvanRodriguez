<?php
// misma DUDA que en incrementar, al actualizar suma intentos

$numeroIntento = null;
$intentos = 0;
$terminado = false;
$maxIntentos = false;
$noNumeroIntento = false;
$noNumeroOculto = false;

if (isset($_COOKIE["numeroOculto"])) {
    $numeroOculto = $_COOKIE["numeroOculto"];
} else {
    $numeroOculto = $_REQUEST["numeroOculto"];
}

if (isset($_REQUEST["numeroIntento"])) {
    $numeroIntento = $_REQUEST["numeroIntento"];
    $intentos = $_COOKIE["intentos"] + 1;
    if ($intentos == 10 && $numeroIntento != $numeroOculto) { // &&: CASO RARO de acertar en el último intento
        $terminado = true;
        $maxIntentos = true;
    } else {
        $terminado = false;
        $maxIntentos = false;
    }
}

if ($numeroIntento == null) { // Si es la primera vez y...
    if (isset($_REQUEST["numeroIntento"])) { // ... si el jugador2 no envia numero de intento
        $noNumeroIntento = true;
        $intentos = $intentos - 1; // restamos el intento fallido
    }
}

if ($numeroOculto == null) { // Si el jugador1 no envia numero oculto
    header("Location: adivinaNumeroInicio.php?noNumeroOculto");
    exit;
}

$intentosRestantes = 10 - $intentos;

setcookie("numeroOculto", $numeroOculto, time() + 60 * 60);
setcookie("intentos", $intentos, time() + 60 * 60);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adivina Número Cookies</title>
</head>
<body>
<?php
// Lo pongo arriba del todo para que en caso de ejecutarlo solo muestre el h1 y acabe.
if ($maxIntentos) {?>
    <h1>Has perdido, se acabaron los intentos.</h1>
<?php exit; // DUDA: se puede? implementar cuando ganas en vez de $terminado=true?
}

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

if ($noNumeroIntento) {?>
    <h2>No has introducido ningún número, inténtalo de nuevo. (Esto no te cuenta como intento)</h2>
<?php }

if (!$terminado) {?>
    <p>Jugador 2, prueba a adivinar el número, tienes <?=$intentosRestantes?> intentos</p>
    <form method="get"> <!-- Action será el mismo php -->
        <input type="number" name="numeroIntento">
        <input type="submit" value="Adivinar">
    </form>
    <?php }
?>
</body>
</html>