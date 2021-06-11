<?php

require_once "Clases.php";
require_once "Varios.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "Ligas"; 
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            echo "\n\nError al conectar:\n" . $e->getMessage();
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) {
            self::$pdo = self::obtenerPdoConexionBd();
        }

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetchAll();

        return $rs;
    }

    private static function ejecutarInsert(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) {
            self::$pdo = self::obtenerPdoConexionBd();
        }

        $insert = self::$pdo->prepare($sql);
        $sqlConExito = $insert->execute($parametros);

        if (!$sqlConExito) {
            return null;
        } else {
            return self::$pdo->lastInsertId();
        }

    }


    private static function ejecutarUpdel(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) {
            self::$pdo = self::obtenerPdoConexionBd();
        }

        $updel = self::$pdo->prepare($sql);
        $sqlConExito = $updel->execute($parametros);

        if (!$sqlConExito) {
            return null;
        } else {
            return $updel->rowCount();
        }

    }

    /* equipo */

    public static function equipoObtenerPorLigaId($ligaId): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM equipo WHERE ligaId=? ORDER BY puntos DESC, dg DESC",
            [$ligaId]
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    private static function equipoCrearDesdeRs(array $fila): equipo
    {
        return new equipo($fila["id"], $fila["nombre"], $fila["puntos"], $fila["dg"], $fila["ligaId"]);
    }

    public static function equipoObtenerPorId(int $id): ?equipo
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM equipo WHERE id=?",
            [$id]
        );

        if ($rs) {
            return self::equipoCrearDesdeRs($rs[0]);
        } else {
            return null;
        }

    }

    public static function equipoObtenerTodos(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM equipo ORDER BY puntos DESC, dg DESC",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    public static function equipoActualizar(equipo $equipo): ?equipo
    {
        $filasAfectadas = self::ejecutarUpdel(
            "UPDATE equipo SET nombre=?, puntos=?, dg=?, ligaId=? WHERE id=?",
            [$equipo->getNombre(), $equipo->getPuntos(), $equipo->getDg(), $equipo->getLigaId(), $equipo->getId()]
        );

        if ($filasAfectadas = null) {
            return null;
        } else {
            return $equipo;
        }

    }
}
