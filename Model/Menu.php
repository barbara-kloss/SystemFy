<?php
class Menu
{
    public readonly int $id;
    public readonly string $dia;
    public readonly string $observacao;
    public readonly string $categoria;
    public readonly Time $horario;
    public readonly User $id_usuario;
    public readonly User $id_nutri;
    public readonly string $titulo;


    function __construct(
        int $id,
        string $dia,
        string $observacao,
        string $categoria,
        Time $horario,
        User $id_usuario,
        User $id_nutri,
        string $titulo
    ) {
        $this->id = $id;
        $this->dia = $dia;
        $this->observacao = $observacao;
        $this->categoria = $categoria;
        $this->id_usuario = $id_usuario;
        $this->id_nutri = $id_nutri;
        $this->titulo = $titulo;
        $this->horario = $horario;
    }

    public function setDia(string $dia)
    {
        if ($dia === false) {
            throw new \InvalidArgumentException("dia invalido!");
        }
        $this->dia = $dia;
    }

    public function setId(int $id)
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException("ID deve ser positivo!");
        }
        $this->id = $id;
    }

    public function setObservacao(string $observacao)
    {
        if (empty($observacao)) {
            throw new \InvalidArgumentException("Observação não pode ser vazia!");
        }
        $this->observacao = $observacao;
    }

    public function setCategoria(string $categoria)
    {
        if (empty($categoria)) {
            throw new \InvalidArgumentException("Categoria não pode ser vazia!");
        }
        $this->categoria = $categoria;
    }

    public function setHorario(Time $horario)
    {
        if (!$horario) {
            throw new \InvalidArgumentException("Horário inválido!");
        }
        $this->horario = $horario;
    }

    public function setIdUsuario(User $id_usuario)
    {
        if (!$id_usuario) {
            throw new \InvalidArgumentException("Usuário inválido!");
        }
        $this->id_usuario = $id_usuario;
    }

    public function setIdNutri(User $id_nutri)
    {
        if (!$id_nutri) {
            throw new \InvalidArgumentException("Nutricionista inválido!");
        }
        $this->id_nutri = $id_nutri;
    }

    public function setTitulo(string $titulo)
    {
        if (empty($titulo)) {
            throw new \InvalidArgumentException("Título não pode ser vazio!");
        }
        $this->titulo = $titulo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDia(): string
    {
        return $this->dia;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getHorario(): Time
    {
        return $this->horario;
    }

    public function getIdUsuario(): User
    {
        return $this->id_usuario;
    }

    public function getIdNutri(): User
    {
        return $this->id_nutri;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }
}

?>