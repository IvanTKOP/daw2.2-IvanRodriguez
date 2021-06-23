<?php

require_once "Clases.php";
require_once "Varios.php";

session_start();

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

    /* EQUIPO */

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

    public static function equipoObtenerCampeones(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "(SELECT * FROM equipo WHERE ligaId=1 ORDER BY puntos DESC, dg DESC LIMIT 1) UNION
            (SELECT * FROM equipo WHERE ligaId=2 ORDER BY puntos DESC, dg DESC LIMIT 1) UNION
            (SELECT * FROM equipo WHERE ligaId=3 ORDER BY puntos DESC, dg DESC LIMIT 1) UNION
            (SELECT * FROM equipo WHERE ligaId=4 ORDER BY puntos DESC, dg DESC LIMIT 1) UNION
            (SELECT * FROM equipo WHERE ligaId=5 ORDER BY puntos DESC, dg DESC LIMIT 1)",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    public static function equipoObtenerClasificados(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "(SELECT * FROM equipo WHERE ligaId=1 ORDER BY puntos DESC, dg DESC LIMIT 6) UNION
            (SELECT * FROM equipo WHERE ligaId=2 ORDER BY puntos DESC, dg DESC LIMIT 6) UNION
            (SELECT * FROM equipo WHERE ligaId=3 ORDER BY puntos DESC, dg DESC LIMIT 6) UNION
            (SELECT * FROM equipo WHERE ligaId=4 ORDER BY puntos DESC, dg DESC LIMIT 6) UNION
            (SELECT * FROM equipo WHERE ligaId=5 ORDER BY puntos DESC, dg DESC LIMIT 6)
            ORDER BY puntos DESC, dg DESC",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

    public static function equipoObtenerDescendidos(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "(SELECT * FROM equipo WHERE ligaId=1 ORDER BY puntos ASC, dg ASC LIMIT 3) UNION
            (SELECT * FROM equipo WHERE ligaId=2 ORDER BY puntos ASC, dg ASC LIMIT 3) UNION
            (SELECT * FROM equipo WHERE ligaId=3 ORDER BY puntos ASC, dg ASC LIMIT 3) UNION
            (SELECT * FROM equipo WHERE ligaId=4 ORDER BY puntos ASC, dg ASC LIMIT 3) UNION
            (SELECT * FROM equipo WHERE ligaId=5 ORDER BY puntos ASC, dg ASC LIMIT 3)",
            []
        );

        foreach ($rs as $fila) {
            $equipo = self::equipoCrearDesdeRs($fila);
            array_push($datos, $equipo);
        }

        return $datos;
    }

//ANTIGUO METODO: MOSTRAR TODOS
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

        if ($filasAfectadas = 0) {
            return null;
        } else {
            return $equipo;
        }

    }

    /* USUARIO */

    public static function usuarioObtenerPorId(int $id): ?Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE id=?", [$id]);
        if ($rs) {
            return self::crearUsuarioDesdeRs($rs);
        } else {
            return null;
        }

    }

    private static function crearUsuarioDesdeRs(array $rs): Usuario
    {
        return new Usuario($rs[0]["id"], $rs[0]["usuario"], $rs[0]["contrasenna"], $rs[0]["nombre"], $rs[0]["apellidos"]);
    }

    public static function obtenerUsuarioPorContrasenna(string $usuario, string $contrasenna): ?Usuario
    {

        $rs = self::ejecutarConsulta(
            "SELECT * FROM Usuario WHERE usuario=? AND BINARY contrasenna=?",
            [$usuario, $contrasenna]
        );

        if ($rs) {
            return self::crearUsuarioDesdeRs($rs);
        } else {
            return null;
        }
    }

    public static function usuarioObtenerPorUsuario($usuario): bool
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE usuario=? ",
            [$usuario]);
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    public static function usuarioCrear(string $usuario, string $nombre, string $apellidos, string $contrasenna): void
    {
        self::ejecutarUpdel("INSERT INTO usuario (usuario, nombre, apellidos, contrasenna) VALUES (?,?,?,?);",
            [$usuario, $nombre, $apellidos, $contrasenna]);
    }

    public static function usuarioBorrar(): void
    {
        self::ejecutarUpdel(
            "DELETE FROM usuario WHERE id=?",
            [$_SESSION["id"]]
        );

    }

/* SESIONES */

    public static function sessionStartSiNoLoEsta()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function establecerSesionRam($arrayUsuario)
    {

        $_SESSION["id"] = $arrayUsuario->getId();

        $_SESSION["usuario"] = $arrayUsuario->getUsuario();
        $_SESSION["nombre"] = $arrayUsuario->getNombre();
        $_SESSION["apellidos"] = $arrayUsuario->getApellidos();
    }

    public static function haySesionRamIniciada()
    {
        self::sessionStartSiNoLoEsta();
        return isset($_SESSION["id"]);
    }

    public static function destruirSesionRamYCookie()
    {
        session_destroy();
        unset($_SESSION); // para dejarla como si nunca hubiese existido
    }

}
