<?php
require_once "_Utilidades.php";
require_once "_Clases.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "fut"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(Self::$pdo)) {
            Self::$pdo =
            Self::obtenerPdoConexionBD();
        }

        $select = Self::$pdo->prepare($sql);
        $select->execute($parametros);
        $resultado = $select->fetchAll();
        return $resultado;
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): void
    {
        if (!isset(self::$pdo)) {
            self::$pdo = self::obtenerPdoConexionBd();
        }

        $actualizacion = self::$pdo->prepare($sql);
        $actualizacion->execute($parametros);
    }

    /*FUNCIONES PARA USUARIO*/

    private static function crearUsuarioDesdeRs(array $rs): Usuario
    {
        return new Usuario($rs[0]["id"], $rs[0]["nombre"], $rs[0]["contrasenna"], $rs[0]["codigoCookie"], $rs[0]["email"], $rs[0]["administrador"]);
    }

    public static function usuarioObtenerPorId(int $id): ?Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE id=?", [$id]);
        if ($rs) {
            return self::crearUsuarioDesdeRs($rs);
        } else {
            return null;
        }

    }

    public static function usuarioObtenerPorEmailYContrasenna($email, $contrasenna): ?Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE email=? AND contrasenna =?", [$email, $contrasenna]);
        if ($rs) {
            return self::crearUsuarioDesdeRs($rs);
        } else {
            return null;
        }

    }

    public static function usuarioObtenerPorEmailYCodigoCookie($email, $codigoCookie): ?Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE email=? AND codigoCookie=?", [$email, $codigoCookie]);
        if ($rs) {
            return self::crearUsuarioDesdeRs($rs);
        } else {
            return null;
        }

    }

    public static function usuarioGuardarCodigoCookie(string $email, string $codigoCookie = null)
    {
        if ($codigoCookie != null) {
            self::ejecutarActualizacion("UPDATE usuario SET codigoCookie=? WHERE email=?", [$codigoCookie, $email]);
        } else {
            self::ejecutarActualizacion("UPDATE usuario SET codigoCookie=NULL WHERE email=?", [$email]);
        }

    }

    public static function usuarioCrear(string $nombre, string $contrasenna, string $email, int $administrador): void
    {
        self::ejecutarActualizacion("INSERT INTO usuario (nombre, contrasenna, codigoCookie, email, administrador) VALUES (?,?,NULL,?,?);",
            [$nombre, $contrasenna, $email, $administrador]);
    }

    public static function usuarioBorrar(): void
    {
        self::ejecutarActualizacion(
            "DELETE FROM usuario WHERE id=?",
            [$_SESSION["id"]]
        );

    }

    public static function usuarioObtenerPorEmail($email): bool
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE email=? ",
            [$email]);
        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

/* FUNCIONES PARA JUGADOR*/

    public static function jugadorObtenerPorId(int $id)
    {
        $rs = self::ejecutarConsulta("SELECT * FROM jugador WHERE id=?", [$id]);
        $jugador = new Jugador($rs[0]["id"], $rs[0]["nombre"], $rs[0]["verssion"], $rs[0]["posicion"], $rs[0]["goles"], $rs[0]["asistencias"], $rs[0]["fichado"]);
        return $jugador;
    }

    public static function jugadorObtenerTodos(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta("SELECT * FROM jugador ORDER BY nombre", []);

        foreach ($rs as $fila) {
            $jugador = new Jugador($fila["id"], $fila["nombre"], $fila["verssion"], $fila["posicion"], $fila["goles"], $fila["asistencias"], $fila["fichado"]);
            array_push($datos, $jugador);
        }

        return $datos;
    }

    public static function agregarJugador($nombre, $verssion, $posicion, $goles, $asistencias, $fichado)
    {
        self::ejecutarActualizacion("INSERT INTO jugador (id, nombre, verssion, posicion, goles, asistencias, fichado) VALUES (NULL, ?, ?, ?, ?, ?, ?);",
            [$nombre, $verssion, $posicion, $goles, $asistencias, $fichado]);
    }

    public static function jugadorActualizar(int $id, string $nuevoNombre, string $nuevaVerssion, string $nuevaPosicion, int $nuevosGoles, int $nuevasAsistencias)
    {
        self::ejecutarActualizacion("UPDATE jugador SET nombre = ?, verssion = ?, posicion =?, goles=?, asistencias=? WHERE id=?",
            [$nuevoNombre, $nuevaVerssion, $nuevaPosicion, $nuevosGoles, $nuevasAsistencias, $id]);
    }

    public static function jugadorEliminar($id)
    {
        self::ejecutarActualizacion(
            "DELETE from jugador WHERE id=?",
            [$id]);
    }

    public static function cambiarFichado(int $jugadorId, int $fichado)
    {
        self::ejecutarActualizacion("UPDATE jugador SET fichado=? WHERE id=?",
            [$fichado, $jugadorId]);
    }

/* EQUIPO */

    public static function crearListadoJugadoresUsuario(int $usuarioId): JugadoresGuardados
    {
        self::ejecutarActualizacion("INSERT INTO equipo (usuario_id) VALUES (?) ", [$usuarioId]);
        $equipo = new JugadoresGuardados($usuarioId, []);
        return $equipo;
    }

    public static function obtenerListadoJugadoresGuardadosId(int $usuarioId): int
    {
        $rsEquipoId = self::ejecutarConsulta(
            "SELECT id FROM equipo WHERE usuario_id=?",
            [$usuarioId]
        );
        $equipoID = $rsEquipoId[0]["id"];
        return $equipoID;
    }

    public static function obtenerListadoJugadoresGuardadosParaUsuario(int $usuarioId)
    {
        $arrayFichajesParaEquipo = array();

        $rs = self::ejecutarConsulta("SELECT * FROM fichaje INNER JOIN equipo ON fichaje.equipo_id = equipo.id WHERE usuario_id=?", [$usuarioId]);
        if (!$rs) {
            return null;
        }
        foreach ($rs as $fila) {
            $fichaje = new Fichaje(
                $fila['jugador_id']
            );
            array_push($arrayFichajesParaEquipo, $fichaje);
        }
        $equipo = new JugadoresGuardados(
            $rs[0]['usuario_id'],
            $arrayFichajesParaEquipo
        );

        return $equipo;
    }

    public static function agregarJugadorListadoJugadoresGuardados(int $usuarioId, $jugadorId): void
    {
        $equipoId = self::obtenerListadoJugadoresGuardadosId($usuarioId);

        self::ejecutarActualizacion(
            "INSERT INTO fichaje (equipo_id, jugador_id) VALUES (?,?) ",
            [$equipoId, $jugadorId]
        );
        self::cambiarFichado($jugadorId, 1);
    }

    /* FICHAJE */

    public static function fichajeEliminar($equipoId, $jugadorId)
    {
        self::ejecutarActualizacion(
            "DELETE from fichaje WHERE equipo_id=? AND jugador_id=?",
            [$equipoId, $jugadorId]);
    }

}
