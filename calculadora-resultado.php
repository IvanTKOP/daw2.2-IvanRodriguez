<?php
    $operando1 = $_REQUEST["operando1"];
    $operacion = $_REQUEST["operacion"];
    $operando2 = $_REQUEST["operando2"];

    $errordivCero = false;

    if ($operacion == "sum") {
        $resultado = ($operando1+$operando2);
    } elseif ($operacion == "res") {
        $resultado= $operando1-$operando2;
    } elseif ($operacion == "mul") {
        $resultado=$operando1*$operando2;
    } elseif ($operacion=="div") {
        $resultado=$operando1/$operando2;
        if($operando1%$operando2==0){
            $resultado=$operando1/$operando2;
        }else{
            $errordivCero=true;
        }

    }
?>



<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php
        if ($errordivCero) {
            ?>
            <p>El resultado es: <?=$resultado?>, no es exacta</p>
    <?php
        } else {
        ?>
            <p>El resultado es: <?=$resultado?></p>
    <?php
        }
    ?>
</body>
</html>
