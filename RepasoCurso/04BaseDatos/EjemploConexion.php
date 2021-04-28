<?php

$servidor = "localhost";
$identificador = "root";
$contrasenna = "";
$bd = "agenda";

$opciones = [
    PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
];

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
} catch (Exception $e) {
    error_log("Error al conectar: " . $e->getMessage());
    exit('Error al conectar');
}

$sql = "SELECT id, nombre FROM categoria ORDER BY nombre"; //sentencia sql

$select = $conexion->prepare($sql); //la preparamos (convertimos string a objeto)

$select->execute([]); // ejecutamos, podemos pasarle parametros si tuvieramos huecos en la sentencia

$rs = $select->fetchAll(); //recogemos los datos, en este caso todos

foreach ($rs as $fila) { // recorremos el array
    $nombre = $fila["nombre"]; // guardamos los datos en variables
    $id = $fila["id"];
    echo ($id . " " . $nombre . " "); // mostramos
}
