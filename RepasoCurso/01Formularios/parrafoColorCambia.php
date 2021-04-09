<?php

$color = $_REQUEST['color'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if ($color == "azul") {
    ?>
 <p style="color:blue;">Azul</p>
<?php
}
if ($color == "rojo") {
    ?>
 <p style="color:red;">Rojo</p>
<?php
}
if ($color == "verde") {
    ?>
 <p style="color:green;">Verde</p>
<?php
}
?>

</body>
</html>
