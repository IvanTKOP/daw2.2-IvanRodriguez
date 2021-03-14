<?php 
require_once "../_com/_Utilidades.php";
require_once "../_com/_Clases.php";

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

    public static function usuarioObtenerPorId(int $id): ?Usuario
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
    $jugador = new Jugador($rs[0]["id"], $rs[0]["nombre"], $rs[0]["verssion"], $rs[0]["posicion"], $rs[0]["goles"], $rs[0]["asistencias"] );
        return $jugador;
}

public static function jugadorObtenerTodos(): array
{
    $datos = [];
    $rs = self::ejecutarConsulta("SELECT * FROM jugador ORDER BY nombre", []);

    foreach ($rs as $fila) {
        $jugador = new Jugador($fila["id"], $fila["nombre"], $fila["verssion"], $fila["posicion"], $fila["goles"], $fila["asistencias"]);
        array_push($datos, $jugador);
    }

    return $datos;
}

public static function agregarJugador($nombre, $verssion, $posicion){
    self::ejecutarActualizacion("INSERT INTO jugador (id, nombre, verssion, posicion, goles, asistencias) VALUES (NULL, ?, ?, ?, ?, ?);",
        [$nombre, $verssion, $posicion, $goles, $asistencias]);
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

public static function jugadorActualizar(int $id, string $nuevoNombre, string $nuevaVerssion, string $nuevaPosicion, int $nuevosGoles, int $nuevasAsistencias)
{
    self::ejecutarActualizacion("UPDATE jugador SET nombre = ?, verssion = ?, posicion =?, goles=?, asistencias=? WHERE id=?",
        [$nuevoNombre, $nuevaVerssion, $nuevaPosicion, $nuevosGoles, $nuevasAsistencias, $id]);
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
    foreach ($rs as $fila){
        $fichaje= new Fichaje(
            $fila['jugador_id'],
            $fila['unidades']
        );
        array_push($arrayFichajesParaEquipo, $fichaje);
    }
    $equipo = new JugadoresGuardados (
        $rs[0]['usuario_id'],
        $arrayFichajesParaEquipo
    );

    return $equipo;
}

public static function agregarJugadorListadoJugadoresGuardados(int $usuarioId, $jugadorId, $unidades): void
{
    $equipoId = self::obtenerListadoJugadoresGuardadosId($usuarioId);

    self::ejecutarActualizacion(
        "INSERT INTO fichaje (equipo_id, jugador_id, unidades) VALUES (?,?,?) ",
        [$equipoId, $jugadorId, $unidades]
    );
}

private static function obtenerNumeroJugadoresGuardados($equipoId, $jugadorId): int
{
    $rs = self::ejecutarConsulta("SELECT unidades FROM fichaje WHERE equipo_id=? AND jugador_id=? ",
        [$equipoId, $jugadorId]);
    if (!$rs) {
        return 0;
    } else {
        return $rs[0]['unidades'];
    }
}
   

public static function listadoUnidades($jugadorId, $nuevaCantidad, $equipoId): void
{
    $udsIniciales = self::obtenerNumeroJugadoresGuardados($equipoId, $jugadorId);
    if ($udsIniciales <= 0) {
        self::ejecutarActualizacion(
            "INSERT INTO fichaje (equipo_id, jugador_id, unidades) VALUES (?,?,?)",
            [$equipoId, $jugadorId, $nuevaCantidad]
        );
    }
    else if ($nuevaCantidad<=0){
        self::fichajeEliminar($equipoId, $jugadorId);
    }
    else {
        self::ejecutarActualizacion(
            "UPDATE fichaje SET unidades=? WHERE equipo_id=? AND jugador_id=?",
            [$nuevaCantidad, $equipoId, $jugadorId]
        );
    }
}

public static function jugadoresGuardadosVariarUnidades($usuarioId, $jugadorId, $variacionUnidades): int
{
    $rsEquipo = self::ejecutarConsulta("SELECT id FROM equipo WHERE usuario_id=?", [$usuarioId]);
        $equipoId = $rsEquipo[0]['id'];
        $unidades = self::obtenerNumeroJugadoresGuardados($equipoId, $jugadorId);
        if ($unidades==0) {
            $nuevaCantidadUnidades = $variacionUnidades;
        } else {
            $nuevaCantidadUnidades = $variacionUnidades + $unidades;
        }
        if ($variacionUnidades==0){
            self::listadoUnidades($jugadorId, $variacionUnidades, $equipoId);
            return $variacionUnidades;
        }
        else {
            self::listadoUnidades($jugadorId, $nuevaCantidadUnidades, $equipoId);
            return $nuevaCantidadUnidades;
        }
    }

    /* FICHAJE */

public static function fichajeEliminar($equipoId, $jugadorId)
    {
        self::ejecutarActualizacion(
            "DELETE from fichaje WHERE equipo_id=? AND jugador_id=?",
            [$equipoId, $jugadorId]);
    }

}
