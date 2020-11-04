<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="calculadora-resultado.php" method="post">
    <input type="number" name="operando1">
    <select name="operacion">
        <option value="sum">Sumar</option>
        <option value="res">Restar</option>
        <option value="mul">Multiplicar</option>
        <option value="div">Dividir</option>
    </select>
    <input type="number" name="operando2">
    <input type="submit" name="Enviar">
</form>
</body>
</html>
