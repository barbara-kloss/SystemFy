<?php
use User;
namespace Systemfy\App\Model;

class Exercise
{
    public int $id;
    public User $user;
    public float $peso;
    public string $repeticao;
    public string $tipo_exercicio;
    public int $dia;
    public string $observacao;
    public string $categoria;
    public User $personal;
    public string $video; // blob convertido em string binária

    public function __construct(
        
        User $user,
        float $peso,
        string $repeticao,
        string $tipo_exercicio,
        int $dia,
        string $observacao,
        int $categoria,
        User $personal,
        string $video
    ) {
        
        $this->user = $user;
        $this->peso = $peso;
        $this->repeticao = $repeticao;
        $this->tipo_exercicio = $tipo_exercicio;
        $this->dia = $dia;
        $this->observacao = $observacao;
        $this->categoria = $categoria;
        $this->personal = $personal;
        $this->video = $video;
    }

    // SETTERS
    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    public function setRepeticao(string $repeticao): void
    {
        $this->repeticao = $repeticao;
    }

    public function setTipoExercicio(string $tipo): void
    {
        $this->tipo_exercicio = $tipo;
    }


    public function setDia(int $dia): void
    {
        $this->dia = $dia;
    }

    public function setObservacao(string $observacao): void
    {
        $this->observacao = $observacao;
    }

    public function setCategoria(int $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function setPersonal(User $personal): void
    {
        $this->personal = $personal;
    }

    public function setVideo(string $video): void
    {
        $this->video = $video;
    }

    // GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getRepeticao(): string
    {
        return $this->repeticao;
    }

    public function getTipoExercicio(): string
    {
        return $this->tipo_exercicio;
    }


    public function getDia(): int
    {
        return $this->dia;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getCategoria(): int
    {
        return $this->categoria;
    }

    public function getPersonal(): User
    {
        return $this->personal;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }
    public function getObjetivo(): int
    {
        return $this->usuario->getObjetivo();
    }
}
?>
