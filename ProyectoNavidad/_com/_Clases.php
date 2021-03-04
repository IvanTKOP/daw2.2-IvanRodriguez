<?php
abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}


        /* CLASE USUARIO */
class Usuario extends Dato
{
    use Identificable;
    private  $usuario;
    private  $contrasenna;
    private  $codigoCookie;
    private  $email;

    public function __construct($id, $usuario, $contrasenna, $email)
    {
        $this->id = ($id);
        $this->setUsuario($usuario);
        $this->setContrasenna($contrasenna);
        $this->setEmail($email);
    }

  

 /* GETTERS USUARIO */
    public function getUsuario() {return $this->usuario;}
    public function getContrasenna() {return $this->contrasenna;}
    public function getEmail() {return $this->email;}

    
    /* SETTERS USUARIO */
    public function setUsuario($usuario){$this->usuario = $usuario;}
    public function setContrasenna($contrasenna){$this->contrasenna = $contrasenna;}
    public function setEmail($email) {$this->usuario = $email;}
}

        /* CLASE JUGADOR */
class Jugador extends Dato
{
    use Identificable;
    private  $nombre;
    private  $verssion;
    private  $posicion;

    public function __construct( int $id=null, string $nombre, string $verssion, string $posicion)
    {
        if ($id != null && $nombre == null) { 

        } else if ($id == null && $nombre != null) {
            DAO::agregarJugador($nombre, $verssion, $posicion);
        } else {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->verssion = $verssion;
            $this->posicion= $posicion;
    }
}

    /* GETTERS JUGADOR */
    public function getNombre(): string{return $this->nombre;}
    public function getVerssion(): string{return $this->verssion;}
    public function getPosicion(): string{return $this->posicion;}
    
    /* SETTERS JUGADOR */
    public function setNombre(string $nombre): void { $this->nombre = $nombre;}
    public function setVerssion(string $verssion): void { $this->verssion = $verssion;}
    public function setPosicion(string $posicion): void { $this->posicion = $posicion;}
}

abstract class ProtoEquipo extends Dato
{

    protected $equipo_id;
    protected $fichajes;

    public function __construct(int $equipo_id, $fichajes)
    {
        $this->equipo_id = $equipo_id;
        $this->fichajes = $fichajes;
    }

    public function getEquipoId(): int
    {
        return $this->equipo_id;
    }

    public function setEquipoId(int $equipo_id)
    {
        $this->equipo_id = $equipo_id;
    }

    public function getFichajes(): array
    {
        return $this->fichajes;
    }

    public function setFichajes(array $fichajes): void
    {
        $this->lineas = $fichajes;
    }
}

    class Fichaje extends ProtoEquipo {

        public function __construct(int $usuario_id, $lineas)
        {
            parent::__construct($usuario_id, $lineas);
        }
    }

    
class Equipo extends ProtoEquipo {
    use Identificable;

    private $nombre;

    public function __constructEquipo(int $id, int $usuario_id, string $nombre, array $lineas)
    {
        parent::__construct($usuario_id, $lineas);

        $this->setId($id);
        $this->setNombre($nombre);
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

   
}

abstract class ProtoFichaje
{
    protected $jugador_id;
    protected $goles;
    protected $asistencias;

    public function __construct(int $jugador_id, int $goles, int $asistencias)
    {
        $this->jugador_id = $jugador_id;
        $this->goles = $goles;
        $this->asistencias = $asistencias;
    }

    public function getJugadorId()
    {
        return $this->jugador_id;
    }

    public function setJugadorId($jugador_id)
    {
        $this->jugador_id = $jugador_id;
    }

    public function getGoles()
    {
        return $this->goles;
    }

    public function setGoles($goles)
    {
        $this->goles = $goles;
    }

    public function getAsistencias()
    {
        return $this->asistencias;
    }

    public function setAsistencias($asistencias)
    {
        $this->goles = $asistencias;
    }
}

class FichajeEquipo extends ProtoFichaje
{
    public function __construct(int $jugador_id, int $goles, int $asistencias)
    {
        parent::__construct($jugador_id, $unidades, $asistencias);
    }
}