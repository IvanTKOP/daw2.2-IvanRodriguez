<?php
abstract class Dato
{
}

trait Identificable
{
    protected $id;

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
    private $nombre;
    private $contrasenna;
    private $codigoCookie;
    private $email;
    private $administrador;

    public function __construct($id, $nombre, $contrasenna, $codigoCookie, $email, $administrador)
    {
        $this->id = ($id);
        $this->setNombre($nombre);
        $this->setContrasenna($contrasenna);
        $this->setCodigoCookie($codigoCookie);
        $this->setEmail($email);
        $this->setAdministrador($administrador);
    }

    /* GETTERS USUARIO */
    public function getNombre()
    {return $this->nombre;}
    public function getContrasenna()
    {return $this->contrasenna;}
    public function getCodigoCookie()
    {return $this->codigoCookie;}
    public function getEmail()
    {return $this->email;}
    public function getAdministrador()
    {return $this->administrador;}

    /* SETTERS USUARIO */
    public function setNombre($nombre)
    {$this->nombre = $nombre;}
    public function setContrasenna($contrasenna)
    {$this->contrasenna = $contrasenna;}
    public function setCodigoCookie($codigoCookie)
    {$this->codigoCookie = $codigoCookie;}
    public function setEmail($email)
    {$this->email = $email;}
    public function setAdministrador($administrador)
    {$this->administrador = $administrador;}
}

/* CLASE JUGADOR */
class Jugador extends Dato
{
    use Identificable;
    private $nombre;
    private $verssion;
    private $posicion;
    private $goles;
    private $asistencias;
    private $fichado;

    public function __construct(int $id = null, string $nombre, string $verssion, string $posicion, int $goles, int $asistencias, int $fichado)
    {
        if ($id != null && $nombre == null) {

        } else if ($id == null && $nombre != null) {
            DAO::agregarJugador($nombre, $verssion, $posicion, $goles, $asistencias, 0);
        } else {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->verssion = $verssion;
            $this->posicion = $posicion;
            $this->goles = $goles;
            $this->asistencias = $asistencias;
            $this->fichado = $fichado;
        }
    }

    /* GETTERS JUGADOR */
    public function getNombre(): string
    {return $this->nombre;}
    public function getVerssion(): string
    {return $this->verssion;}
    public function getPosicion(): string
    {return $this->posicion;}
    public function getGoles(): int
    {return $this->goles;}
    public function getAsistencias(): int
    {return $this->asistencias;}
    public function getFichado(): int
    {return $this->fichado;}

    /* SETTERS JUGADOR */
    public function setNombre(string $nombre): void
    {$this->nombre = $nombre;}
    public function setVerssion(string $verssion): void
    {$this->verssion = $verssion;}
    public function setPosicion(string $posicion): void
    {$this->posicion = $posicion;}
    public function setGoles(string $goles): void
    {$this->goles = $goles;}
    public function setAsistencias(string $asistencias): void
    {$this->asistencias = $asistencias;}
    public function setFichado(string $fichado): void
    {$this->fichado = $fichado;}
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

class JugadoresGuardados extends ProtoEquipo
{

    public function __construct(int $usuario_id, $fichajes)
    {
        parent::__construct($usuario_id, $fichajes);
    }

}

class Equipo extends ProtoEquipo
{

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

    public function __construct(int $jugador_id)
    {
        $this->jugador_id = $jugador_id;
    }

    public function getJugadorId()
    {
        return $this->jugador_id;
    }

    public function setJugadorId($jugador_id)
    {
        $this->jugador_id = $jugador_id;
    }

}

class Fichaje extends ProtoFichaje
{
    public function __construct(int $jugador_id)
    {
        parent::__construct($jugador_id);
    }
}
