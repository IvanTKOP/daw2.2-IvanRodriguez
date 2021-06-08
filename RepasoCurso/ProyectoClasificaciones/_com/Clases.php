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

class Liga extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private ?array $equiposPertenecientes;

    public function __construct(int $id, string $nombre)
    {
        $this->id = $id;
        $this->setNombre($nombre);
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
        ];
    }

    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function obtenerEquiposPertenecientes(): array
    {
        if ($this->equiposPertenecientes == null) {
            $equiposPertenecientes = DAO::equipoObtenerPorLiga($this->id);
        }

        return $equiposPertenecientes;
    }
}

class Equipo extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private int $puntos;
    private int $ligaId;
    private ?Liga $liga;

    public function __construct(int $id, string $nombre, int $puntos, int $ligaId)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->puntos = $puntos;
        $this->ligaId = $ligaId;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "puntos" => $this->puntos,
            "ligaId" => $this->ligaId,
        ];
    }

    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPuntos(): int
    {
        return $this->puntos;
    }

    public function setPuntos(int $puntos): void
    {
        $this->puntos = $puntos;
    }


    public function getLigaId(): int
    {
        return $this->ligaId;
    }

    public function setLigaId(int $ligaId): void
    {
        $this->ligaId = $ligaId;
    }

    public function obtenerLiga(): Liga
    {
        if ($this->liga == null) {
            $liga = DAO::ligaObtenerPorId($this->ligaId);
        }

        return $liga;
    }
}
