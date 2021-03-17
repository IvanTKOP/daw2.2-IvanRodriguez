
<html>

<head>
    <meta charset="UTF-8">
</head>
<style>
    .div1{
            left: 400px;
            position:relative;
            text-align:center;
            width: 40%;
            background-color:#E7E7E7;
        }
</style>
<body>
<div class="div1">
<h1>Registro</h1>
<?php
if (isset($_REQUEST["error"])) {
    echo "<p>Error, introduzca correctamente los datos</p>";
}
if (isset($_REQUEST["existe"])) {
    echo "<p>Este email ya existe. Por favor introduzca uno diferente</p>";
}
?>


<form action="usuario-registro-guardar.php">
    Email <input type="email" name="email" required><br>
    Contraseña <input type="password" name="contrasenna" required><br>
    Nombre <input type="text" name="nombre" required><br>
    ¿Cuenta Admin? <input type="radio" name="administrador" value=1>Si <input type="radio" name="administrador" value=0> No<br><br>
    <input type="submit" name="submit">
</form>
</div>
</body>
</html>
