<?php
    require_once "_Varios.php";
    if (!sesionIniciada()) {
        redireccionar("SesionInicioComprobar.php");
    }
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<?php
    infoSesion();
?>

<body>

<h1>Contenido Privado 2 </h1>

<p>Curabitur nulla urna, tempor at justo vel, pulvinar condimentum lectus. Aliquam orci libero, accumsan vitae sagittis quis, feugiat at quam. Etiam eget dui enim. Maecenas a tortor ac justo suscipit elementum eu in diam. Sed velit ipsum, commodo at pellentesque eu, mattis a urna. Sed eu rhoncus felis, vitae rhoncus mi. Nam ornare luctus ex a rhoncus. Suspendisse potenti. Donec lobortis urna nunc, et lacinia orci consectetur quis. Curabitur commodo suscipit finibus. Fusce congue iaculis dui, ac tincidunt arcu dignissim id. Phasellus quam elit, pretium nec rutrum et, lacinia sit amet elit.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate velit ut augue vehicula, id efficitur velit efficitur. Duis sed gravida lectus. Nunc egestas purus eros, at ullamcorper neque tincidunt vel. Ut dolor nisi, condimentum id ex non, cursus convallis sapien. Ut sapien dui, consectetur nec vestibulum vel, semper eget enim. Integer aliquet vehicula eros et mattis. Suspendisse finibus dictum erat vulputate tempor. Maecenas vel ante vitae massa fringilla molestie. Sed malesuada mauris ut ipsum pulvinar sollicitudin id vel nunc. Donec non gravida mi. Vivamus mi nisl, lacinia ac scelerisque a, lacinia at nulla. In in est nibh. Vivamus et magna quis diam tristique mollis sit amet ut lectus. Pellentesque faucibus facilisis lacus sit amet aliquam. Etiam euismod mi metus, non volutpat dui interdum in. Suspendisse vel efficitur urna.</p>

<a href="ContenidoPublico1.php"> Ir a Contenido Público</a> <br><br>

<a href="ContenidoPrivado1.php"> Ir a Contenido Privado 1</a>

</body>
</html>