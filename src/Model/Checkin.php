<?php

namespace Systemfy\App\Model;

class Checkin
{
    private ?int $id;
    private int $id_user;
    private int $id_exercise;
    private string $categoria;
    private string $data_checkin;

    public function __construct(
        int $id_user,
        int $id_exercise,
        string $categoria,
        string $data_checkin,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_exercise = $id_exercise;
        $this->categoria = $categoria;
        $this->data_checkin = $data_checkin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getIdExercise(): int
    {
        return $this->id_exercise;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getDataCheckin(): string
    {
        return $this->data_checkin;
    }
}


