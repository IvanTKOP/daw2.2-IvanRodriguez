<?php
$ciudad = $_REQUEST['ciudad']; //duda comillas aqui
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Tu ciudad favorita es <a href="https://www.google.com/search?q=<?=$ciudad?>"><?=$ciudad?></p>
</body>
</html>