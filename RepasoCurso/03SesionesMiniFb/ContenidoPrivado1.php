<?php

require_once "_Varios.php";

if (!haySesionRamIniciada()) {
    redireccionar("SesionInicioFormulario.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido Privado 1</title>
</head>
<body>
<?php pintarInfoSesion();?>
    <h1>Contenido Privado 1</h1>
    <p>Sed quis justo id nisl hendrerit fringilla. Nullam venenatis mattis nisl, eu dignissim dolor mattis mollis. Maecenas eget urna venenatis, rhoncus turpis vel, accumsan lorem. In quis malesuada erat, in fermentum arcu. Integer nec viverra dolor. Donec suscipit ante eu sapien tristique efficitur et molestie nunc. Curabitur quis orci vitae eros dignissim pellentesque eu sed metus. Cras posuere mollis arcu, et mollis velit semper quis. Nam eleifend leo vel ultricies eleifend. Vestibulum porttitor blandit placerat. Quisque elementum sed erat id lobortis. Donec sed purus mi. Ut ut iaculis lectus. Quisque porta mi dui, et convallis eros interdum at.</p>

    <a href="contenidoPrivado2.php">Ir a Contenido Privado 2</a>
    <a href="contenidoPublico1.php">Ir a Contenido Publico 1</a>
</body>
</html>
