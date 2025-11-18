<?php
namespace Systemfy\App\Model;

class Menu
{
    public int $id;
    public string $horario;         // TIME - armazenado como string "HH:MM:SS"
    public int $categoria;
    public string $observacao;
    public User $usuario;           // id_user
    public User $nutri;             // id_nutri
    public string $titulo;

    public function __construct(
        int $id,
        string $horario,
        int $categoria,
        string $observacao,
        User $usuario,
        User $nutri,
        string $titulo
    ) {
        $this->id = $id;
        $this->horario = $horario;
        $this->categoria = $categoria;
        $this->observacao = $observacao;
        $this->usuario = $usuario;
        $this->nutri = $nutri;
        $this->titulo = $titulo;
    }

    // SETTERS
    public function setHorario(string $horario): void
    {
        $this->horario = $horario;
    }

    public function setCategoria(int $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function setObservacao(string $observacao): void
    {
        $this->observacao = $observacao;
    }

    public function setUsuario(User $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function setNutri(User $nutri): void
    {
        $this->nutri = $nutri;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    // GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getHorario(): string
    {
        return $this->horario;
    }

    public function getCategoria(): int
    {
        return $this->categoria;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getUsuario(): User
    {
        return $this->usuario;
    }

    public function getNutri(): User
    {
        return $this->nutri;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    //  Pega o objetivo vindo da tabela User
    public function getObjetivo(): int
    {
        return $this->usuario->getObjetivo();
    }
}
?>
