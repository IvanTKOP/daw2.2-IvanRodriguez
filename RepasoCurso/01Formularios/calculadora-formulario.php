<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="calculadora-resultado.php" method="get">
        <input type="number" name="operando1">
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select>
        <input type="number" name="operando2">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
