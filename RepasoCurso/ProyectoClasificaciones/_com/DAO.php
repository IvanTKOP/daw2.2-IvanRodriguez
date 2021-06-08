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
        $bd = "Ligas"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
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

    // Devuelve:
    //   - null: si ha habido un error
    //   - int: el id autogenerado para el nuevo registro.
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

    // Ejecuta un Update o un Delete.
    // Devuelve:
    //   - null: si ha habido un error
    //   - 0, 1 u otro número positivo: OK (no errores) y estas son las filas afectadas.
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

    /* liga */

    private static function ligaCrearDesdeRs(array $fila): liga
    {
        return new Liga($fila["id"], $fila["nombre"]);
    }

    public static function ligaObtenerPorId(int $id): ?liga
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM liga WHERE id=?",
            [$id]
        );

        if ($rs) {
            return self::ligaCrearDesdeRs($rs[0]);
        } else {
            return null;
        }

    }

    public static function ligaObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM liga ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $liga = self::ligaCrearDesdeRs($fila);
            array_push($datos, $liga);
        }

        return $datos;
    }

    public static function ligaCrear(string $nombre): ?liga
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO liga (nombre) VALUES (?)",
            [$nombre]
        );

        if ($idAutogenerado == null) {
            return null;
        } else {
            return self::ligaObtenerPorId($idAutogenerado);
        }

    }

    public static function ligaActualizar(liga $liga): ?liga
    {
        $filasAfectadas = self::ejecutarUpdel(
            "UPDATE liga SET nombre=? WHERE id=?",
            [$liga->getNombre(), $liga->getId()]
        );

        if ($filasAfectadas = null) {
            return null;
        } else {
            return $liga;
        }

    }

    public static function ligaEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM liga WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function ligaEliminar(liga $liga): bool
    {
        return self::ligaEliminarPorId($liga->id);
    }

    /* equipo */

    private static function equipoCrearDesdeRs(array $fila): equipo
    {
        return new equipo($fila["id"], $fila["nombre"], $fila["puntos"], $fila["ligaId"]);
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

    public static function equipoObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM equipo ORDER BY nombre, puntos",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    public static function equipoCrear(string $nombre, string $apellidos, string $telefono, bool $estrella, int $ligaId): ?equipo
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO equipo (nombre, apellidos, telefono, estrella, ligaId) VALUES (?, ?, ?, ?, ?)",
            [$nombre, $apellidos, $telefono, $estrella ? 1 : 0, $ligaId]
        );

        if ($idAutogenerado == null) {
            return null;
        } else {
            return self::equipoObtenerPorId($idAutogenerado);
        }

    }

    public static function equipoActualizar(equipo $equipo): ?equipo
    {
        $filasAfectadas = self::ejecutarUpdel(
            "UPDATE equipo SET nombre=?, apellidos=?, telefono=?, estrella=?, ligaId=? WHERE id=?",
            [$equipo->getNombre(), $equipo->getApellidos(), $equipo->getTelefono(), $equipo->isEstrella() ? 1 : 0, $equipo->getligaId(), $equipo->getId()]
        );

        if ($filasAfectadas = null) {
            return null;
        } else {
            return $equipo;
        }

    }

    public static function equipoEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM equipo WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function equipoEliminar(equipo $equipo): bool
    {
        return self::equipoEliminarPorId($equipo->id);
    }
}
