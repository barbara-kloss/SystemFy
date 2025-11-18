<?php

namespace Systemfy\App\Model;

class Exercise
{
    public ?int $id;
    public int $id_user; // NOT NULL no banco
    public ?float $peso; // nullable no banco
    public ?string $repeticao; // nullable no banco
    public ?string $tipo_exercicio; // nullable no banco
    public ?int $dia; // nullable no banco
    public ?string $observacao; // nullable no banco
    public ?string $categoria; // nullable no banco
    public ?int $id_personal; // nullable no banco
    public ?string $video; // nullable no banco

    public function __construct(
        int $id_user,
        ?float $peso = null,
        ?string $repeticao = null,
        ?string $tipo_exercicio = null,
        ?int $dia = null,
        ?string $observacao = null,
        ?string $categoria = null,
        ?int $id_personal = null,
        ?string $video = null,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->peso = $peso;
        $this->repeticao = $repeticao;
        $this->tipo_exercicio = $tipo_exercicio;
        $this->dia = $dia;
        $this->observacao = $observacao;
        $this->categoria = $categoria;
        $this->id_personal = $id_personal;
        $this->video = $video;
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
