<?php

namespace Systemfy\App\Model;

class Menu
{
    public ?int $id;
    public ?string $horario; // nullable no banco (time)
    public ?int $categoria; // nullable no banco
    public ?string $observacao; // nullable no banco
    public ?int $id_user; // nullable no banco
    public ?int $id_nutri; // nullable no banco
    public ?string $titulo; // nullable no banco

    public function __construct(
        ?string $horario = null,
        ?int $categoria = null,
        ?string $observacao = null,
        ?int $id_user = null,
        ?int $id_nutri = null,
        ?string $titulo = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->horario = $horario;
        $this->categoria = $categoria;
        $this->observacao = $observacao;
        $this->id_user = $id_user;
        $this->id_nutri = $id_nutri;
        $this->titulo = $titulo;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
