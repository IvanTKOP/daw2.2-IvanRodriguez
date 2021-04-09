<?php

$operando1 = $_REQUEST['operando1'];
$operacion = $_REQUEST['operacion'];
$operando2 = $_REQUEST['operando2'];

$errorDivCero = false;

if ($operacion == "suma") {
    $resultado = $operando1 + $operando2;
}

if ($operacion == "resta") {
    $resultado = $operando1 - $operando2;
}

if ($operacion == "multiplicar") {
    $resultado = $operando1 * $operando2;
}

if ($operacion == "dividir") {
    if ($operando1 % $operando2 != 0) {
        $errorDivCero = true;
    } else {
        $resultado = $operando1 / $operando2;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php if (!$errorDivCero) {?>
    <p>El resultado es : <?=$resultado?></p>
<?php } else {?>
    <p>La división no es exacta</p>
<?php }?>
</body>
</html>
