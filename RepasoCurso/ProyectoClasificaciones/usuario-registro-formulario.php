
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="#" />
    <link rel="stylesheet" href="css/Estilos.css" />
    <title>Registro Formulario</title>
</head>

<body>
<div class="div1">
<h1>Registro de Usuario</h1>
<?php
if (isset($_REQUEST["error"])) {
    echo "<p style='color:red>Error, introduzca correctamente los datos</p>";
}
if (isset($_REQUEST["existe"])) {
    echo "<p style='color:red>Este usuario ya existe. Por favor introduzca uno diferente</p>";
}
?>

    <form action="usuario-registro-guardar.php">
        <h2>Cuenta</h2>
        
        <p>Usuario: <input type="usuario" name="usuario" required><br></p>
        <p>Contraseña: <input type="password" name="contrasenna" required><br><br></p>
        
        <h2>Datos Personales</h2>
    
        <p>Nombre: <input type="text" name="nombre" required><br></p>
        <p>Apellidos: <input type="text" name="apellidos" required><br><br></p>
        
        <input class="boton" type="submit" name="submit">
    </form>

</div>
</body>
</html>
