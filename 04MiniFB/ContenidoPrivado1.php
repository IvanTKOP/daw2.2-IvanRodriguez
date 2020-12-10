<?php
    require_once "_Varios.php";
    if (!sesionIniciada()) {
        redireccionar("SesionInicioFormulario.php");
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

<h1>Contenido Privado 1 </h1>

<p>Sed et eros a odio eleifend aliquam nec rutrum massa. Duis id vestibulum dolor. Suspendisse viverra tortor mi, a eleifend nisi fringilla condimentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at velit id ligula hendrerit volutpat. Nunc sem velit, finibus in pretium eget, iaculis vitae ipsum. Sed tempor lectus sit amet odio blandit tempor. Mauris vitae hendrerit nisi. Duis ac leo et diam sodales congue ac id nunc. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec et ullamcorper neque. Etiam pellentesque, justo fringilla commodo imperdiet, mi sapien commodo felis, ac sollicitudin mauris velit vitae nibh. Proin tincidunt tristique neque, at lobortis tellus semper ut. Sed ut faucibus nulla. Nulla nec viverra libero. In auctor tempus auctor.</p>

<p>Fusce at pellentesque leo. Proin orci tortor, rhoncus vel velit eu, tempus malesuada turpis. Vivamus hendrerit aliquam tincidunt. Ut est lorem, sagittis eget egestas viverra, varius posuere risus. Proin vitae augue et justo vulputate finibus. Suspendisse potenti. Praesent arcu ex, ultrices ut tincidunt in, semper et lorem.</p>

<a href="ContenidoPublico1.php"> Ir a Contenido Público</a> <br><br>

<a href="ContenidoPrivado2.php"> Ir a Contenido Privado 2</a>

</body>
</html>

