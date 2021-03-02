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

        /* CLASE POSICION */
class Posicion extends Dato
{
    use Identificable;

    private string $nombre;

    public function __construct(int $id, string $nombre)
    {
        $this->setId($id);
        $this->setnombre($nombre);
    }

    public function getnombre(): string
    {
        return $this->nombre;
    }

    public function setnombre(string $nombre)
    {
        $this->nombre = $nombre;
    }
}

        /* CLASE USUARIO */
class Usuario extends Dato
{
    use Identificable;
    private string $usuario;
    private string $contrasenna;
    private string $codigoCookie;

    public function __construct(int $id, string $usuario, string $contrasenna, string $codigoCookie)
    {
        $this->setId($id);
        $this->setUsuario($usuario);
        $this->setContrasenna($contrasenna);
        $this->setCodigoCookie($codigoCookie);
    }
 /* GETTERS USUARIO */
    public function getUsuario(): string{return $this->usuario;}
    public function getContrasenna(): string{return $this->contrasenna;}
    public function getCodigoCookie(): string{return $this->codigoCookie;}
    
    /* SETTERS USUARIO */
    public function setUsuario(string $usuario): void{$this->usuario = $usuario;}
    public function setContrasenna(string $contrasenna): void{$this->contrasenna = $contrasenna;}
    public function setCodigoCookie(string $codigoCookie): void{$this->codigoCookie = $codigoCookie;}
}

        /* CLASE JUGADOR */
class Jugador extends Dato
{
    use Identificable;
    private string $nombre;
    private string $verssion;
    private int $goles;
    private int $asistencias;
    private string $id;

    public function __construct(int $id, string $nombre, string $verssion, int $goles, int $asistencias, string $id)
    {
        $this->setId($id);
        $this->setnombre($nombre);
        $this->setVerssion($verssion);
        $this->setGoles($goles);
        $this->setAsistencias($asistencias);
        $this->setidJ($idJ);
    }

    /* GETTERS JUGADOR */
    public function getnombre(): string{return $this->nombre;}
    public function getVerssion(): string{return $this->verssion;}
    public function getGoles(): int{return $this->goles;}
    public function getAsistencias(): int{return $this->asistencias;}
    public function getidJ(): string{return $this->idJ;}
    
    /* SETTERS JUGADOR */
    public function setnombre(): string{return $this->nombre;}
    public function setVerssion(): string{return $this->verssion;}
    public function setGoles(): int{return $this->goles;}
    public function setAsistencias(): int{return $this->asistencias;}
    public function setidJ(string $idJ): void
        {
            $this->idJ = $idJ;
        }
}

   
    /* CLASE EQUIPO */
    class Equipo extends Dato
    {
        use Identificable;

        private string $nombre;

        public function __construct(int $id, string $nombre)
        {
            $this->setid($id);
            $this->setnombre($nombre);
        }   
    
        /* GETTERS EQUIPO */
        public function getnombre(): string{return $this->nombre;}

         /* SETTERS EQUIPO */
         public function setnombre(string $nombre)
         {
             $this->nombre = $nombre;
         }
    
    }




