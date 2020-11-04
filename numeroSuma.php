<?php
if (!isset($_REQUEST["numero"])) $numero = 0;
else $numero = ++$_REQUEST["numero"];
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php
if ($numero==0) {
    ?>

    <p>Introduce número: </p>
    <form action='' method='get'>
        <input type='text' name='numero' />
        <input type='submit' name='boton' value="+1" />
    </form>

    <?php
} else {
    ?>
    <p>Tu número es <?=$numero?></p>
    <button>-1</button>
    <button>+1</button>
<?php
}
?>


</body>

</html>