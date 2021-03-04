<?php 
require_once "_com/_Varios.php";
require_once "_com/_Clases.php";

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
        if(!isset(Self::$pdo)) Self::$pdo = 
        Self::obtenerPdoConexionBD();

        $select = Self::$pdo->prepare($sql);
        $select->execute($parametros);
        $resultado = $select->fetchAll();
        return $resultado;
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): void
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        $actualizacion->execute($parametros);
    }


    /*FUNCIONES PARA USUARIO*/

    private static function crearUsuarioDesdeRs(array $rs):Usuario
    {
        return new Usuario($rs[0]["id"], $rs[0]["usuario"], $rs[0]["contrasenna"], $rs[0]["codigoCookie"], $rs[0]["email"]);
    }

    public static function usuarioObtenerPorId(int $id): ?Cliente
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE id=?", [$id]);
        if ($rs) return self::crearUsuarioDesdeRs($rs);
        else return null;
    }

    public static function usuarioObtenerPorEmailYContrasenna($email, $contrasenna): ?Usuario 
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE email=? AND contrasenna =?", [$email, $contrasenna]);
        if ($rs) return self::crearUsuarioDesdeRs($rs);
        else return null;
    }

    public static function usuarioObtenerPorEmailYCodigoCookie($email, $codigoCookie): ?Usuario
{
    $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE email=? AND codigoCookie=?", [$email, $codigoCookie]);
    if ($rs) return self::usuarioCrearDesdeRs($rs);
    else return null;
}

public static function usuarioGuardarCodigoCookie(string $email, string $codigoCookie = null)
    {
        if ($codigoCookie != null)
        {
            self::ejecutarActualizacion("UPDATE usuario SET codigoCookie=? WHERE email=?", [$codigoCookie, $email]);
        } else {
            self::ejecutarActualizacion("UPDATE usuario SET codigoCookie=NULL WHERE email=?", [$email]);
        }

    }

    public static function usuarioCrear(string $email, string $contrasenna, string $usuario): void
    {
        self::ejecutarActualizacion("INSERT INTO usuario (email, contrasenna, codigoCookie, usuario) VALUES (?,?,NULL,?);",
            [$email, $contrasenna, $usuario]);
    }

    public static function usuarioActualizar():void
    {
        self::ejecutarActualizacion(
            "UPDATE usuario SET email=\"\*\*\*\*\*\", contrasenna=\"\*\*\*\*\*\", codigoCookie=NULL, usuario=\"\*\*\*\*\*\" WHERE id=?",
            [ $_SESSION["id"]]
        );
        self::equipoActualizarDireccion($_SESSION["id"]);
    }

    public static function usuarioObtenerPorEmail($email):bool
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
    $oferta = new Jugador($rs[0]["id"], $rs[0]["nombre"], $rs[0]["verssion"], $rs[0]["posicion"]);
        return $jugador;
}

public static function jugadorObtenerTodos(): array
{
    $datos = [];
    $rs = self::ejecutarConsulta("SELECT * FROM jugador ORDER BY nombre", []);

    foreach ($rs as $fila) {
        $oferta = new Jugador($rs[0]["id"], $rs[0]["nombre"], $rs[0]["verssion"], $rs[0]["posicion"]);
        array_push($datos, $jugador);
    }

    return $datos;
}

public static function agregarJugador($nombre, $verssion, $posicion){
    self::ejecutarActualizacion("INSERT INTO jugador (id, nombre, verssion, posicion) VALUES (NULL, ?, ?, ?);",
        [$nombre, $verssion, $posicion]);
}

public static function jugadoresEquipoObtener(): array
{
    $datos = [];
    $rs = self::ejecutarConsulta("SELECT * FROM jugador WHERE fichado=1 ORDER BY id", []);

    foreach ($rs as $fila) {
        $jugador = self::jugadorCrearDesdeRs($fila);
        array_push($datos, $jugador);
    }

    return $datos;
}

public static function jugadorActualizar(int $id, string $nuevoNombre, string $nuevaVerssion, int $nuevaPosicion)
{
    self::ejecutarActualizacion("UPDATE jugador SET nombre = ?, verssion = ?, posicion =? WHERE id=?",
        [$nuevoNombre, $nuevaVerssion, $nuevaPosicion, $id]);
}


/* CARRITO */

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

public static function obtenerListadoJugadoresGuardadosParaCliente(int $usuarioId)
{
    $arrayFichajesParaEquipo = array();

    $rs = self::ejecutarConsulta("SELECT * FROM fichaje INNER JOIN equipo ON fichaje.equipo_id = equipo.id WHERE usuario_id=?", [$usuarioId]);
    if (!$rs) {
        return null;
    }
    foreach ($rs as $fila){
        $fichaje= new FichajeEquipo(
            $fila['jugador_id'],
            $fila['goles'],
            $fila['asistencias']
        );
        array_push($arrayFichajesParaEquipo, $fichaje);
    }
    $equipo = new JugadoresGuardados (
        $rs[0]['usuario_id'],
        $arrayFichajesParaEquipo
    );

    return $equipo;
}

public static function agregarJugadorListadoJugadoresGuardados(int $usuarioId, $jugadorId, $goles, $asistencias): void
{
    $equipoId = self::obtenerListadoJugadoressGuardadosId($usuarioId);

    self::ejecutarActualizacion(
        "INSERT INTO fichaje (equipo_id, jugador_id, goles, asistencias) VALUES (?,?,?,?) ",
        [$equipoId, $jugadorId, $goles, $asistencias]
    );
}

private static function obtenerGolesJugadoresGuardados($equipoId, $jugadorId): int
{
    $rs = self::ejecutarConsulta("SELECT goles FROM fichaje WHERE equipo_id=? AND jugador_id=? ",
        [$equipoId, $jugadorId]);
    if (!$rs) {
        return 0;
    } else {
        return $rs[0]['goles'];
    }
}

private static function obtenerAsistenciasJugadoresGuardados($equipoId, $jugadorId): int
{
    $rs = self::ejecutarConsulta("SELECT asistencias FROM fichaje WHERE equipo_id=? AND jugador_id=? ",
        [$equipoId, $jugadorId]);
    if (!$rs) {
        return 0;
    } else {
        return $rs[0]['asistencias'];
    }
}

public static function listadoGoles($jugadorId, $nuevoGoles, $equipoId): void
{
    $golesIniciales = self::obtenerNumeroJugadoresGuardados($equipoId, $jugadorId);
    if ($golesIniciales <= 0) {
        self::ejecutarActualizacion(
            "INSERT INTO fichaje (equipo_id, jugador_id, goles) VALUES (?,?,?)",
            [$equipoId, $jugadorId, $nuevoGoles]
        );
    }
    else if ($nuevoGoles<=0){
        self::fichajeEliminar($equipoId, $jugadorId);
    }
    else {
        self::ejecutarActualizacion(
            "UPDATE fichaje SET goles=? WHERE equipo_id=? AND jugador_id=?",
            [$nuevoGoles, $equipoId, $jugadorId]
        );
    }
}

public static function listadoAsistencias($jugadorId, $nuevoAsistencias, $equipoId): void
{
    $asistenciasIniciales = self::obtenerNumeroJugadoresGuardados($equipoId, $jugadorId);
    if ($asistenciasIniciales <= 0) {
        self::ejecutarActualizacion(
            "INSERT INTO fichaje (equipo_id, jugador_id, asistencias) VALUES (?,?,?)",
            [$equipoId, $jugadorId, $nuevoAsistencias]
        );
    }
    else if ($nuevoAsistencias<=0){
        self::fichajeEliminar($equipoId, $jugadorId);
    }
    else {
        self::ejecutarActualizacion(
            "UPDATE fichaje SET asistencias=? WHERE equipo_id=? AND jugador_id=?",
            [$nuevoAsistencias, $equipoId, $jugadorId]
        );
    }
}

public static function fichajeEliminar($equipoId, $jugadorId)
    {
        self::ejecutarActualizacion(
            "DELETE from fichaje WHERE equipo_id=? AND jugador_id=?",
            [$equipoId, $jugadorId]);
    }

}
