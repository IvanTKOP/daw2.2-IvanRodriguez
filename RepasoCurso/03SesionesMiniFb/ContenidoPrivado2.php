<?php

require_once "_Varios.php";

if (!haySesionRamIniciada()) {
    redireccionar('SesionInicioFormulario.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="text-align:center;">Contenido Privado 2</title>
</head>
<body>
    <?php pintarInfoSesion();?>

    <br><br>
    <div style="text-align:center;">
        <img src="_img/cPrivado.png" height="100" width="100">

        <h1>Contenido Privado 2</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent facilisis interdum congue. Nulla imperdiet augue eget arcu facilisis, non mattis sem feugiat. Sed ullamcorper felis non nulla pretium, quis aliquet arcu efficitur. Integer at dolor risus. Vivamus consectetur convallis ligula a laoreet. Nam eleifend risus nec mauris facilisis porttitor. Etiam varius, metus sed hendrerit porta, nibh lectus egestas ex, ut pharetra nisi tortor non elit. Cras felis metus, tincidunt ac risus a, finibus suscipit elit. Cras elementum ipsum sed mi finibus, sed condimentum sapien tempus.</p>

        <a href='ContenidoPrivado1.php'>Ir a Contenido Privado 1</a>
        <br><br>
        <a href='ContenidoPublico1.php'>Ir a Contenido Público 1</a>

    </div>
</body>
</html>