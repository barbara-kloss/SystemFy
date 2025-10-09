<?php
use User;
class Exercise
{
    public readonly int $id;
    public readonly float $peso;
    public readonly string $repeticao;
    public readonly string $exercicio;
    public readonly string $categoria;
    public readonly string $dia;
    public readonly string $obs;
    public readonly User $id_usuario;
    public readonly User $id_personal;
    public function __construct(
        int $id,
        float $peso,
        string $repeticao,
        string $exercicio,
        string $categoria,
        string $dia,
        string $obs,
        User $id_usuario,
        User $id_personal
    ) {
        $this->id = $id;
        $this->peso = $peso;
        $this->repeticao = $repeticao;
        $this->exercicio = $exercicio;
        $this->categoria = $categoria;
        $this->dia = $dia;
        $this->obs = $obs;
        $this->id_usuario = $id_usuario;
        $this->id_personal = $id_personal;
    }

    public function setId(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException("ID deve ser positivo!");
        }
        $this->id = $id;
    }

    public function setPeso(float $peso)
    {
        if ($peso < 0) {
            throw new \InvalidArgumentException("Peso não pode ser negativo!");
        }
        $this->peso = $peso;
    }

    public function setRepeticao(string $repeticao)
    {
        if (empty($repeticao)) {
            throw new \InvalidArgumentException("Repetição não pode ser vazia!");
        }
        $this->repeticao = $repeticao;
    }

    public function setExercicio(string $exercicio)
    {
        if (empty($exercicio)) {
            throw new \InvalidArgumentException("Exercício não pode ser vazio!");
        }
        $this->exercicio = $exercicio;
    }

    public function setCategoria(string $categoria)
    {
        if (empty($categoria)) {
            throw new \InvalidArgumentException("Categoria não pode ser vazia!");
        }
        $this->categoria = $categoria;
    }

    public function setDia(string $dia)
    {
        if (empty($dia)) {
            throw new \InvalidArgumentException("Dia não pode ser vazio!");
        }
        $this->dia = $dia;
    }

    public function setObs(string $obs)
    {
        $this->obs = $obs;
    }

    public function setIdUsuario(User $id_usuario)
    {
        if (!$id_usuario) {
            throw new \InvalidArgumentException("Usuário inválido!");
        }
        $this->id_usuario = $id_usuario;
    }

    public function setIdPersonal(User $id_personal)
    {
        if (!$id_personal) {
            throw new \InvalidArgumentException("Personal inválido!");
        }
        $this->id_personal = $id_personal;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getRepeticao(): string
    {
        return $this->repeticao;
    }

    public function getExercicio(): string
    {
        return $this->exercicio;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getDia(): string
    {
        return $this->dia;
    }

    public function getObs(): string
    {
        return $this->obs;
    }

    public function getIdUsuario(): User
    {
        return $this->id_usuario;
    }

    public function getIdPersonal(): User
    {
        return $this->id_personal;
    }
}
?>