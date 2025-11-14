<?php
use User;
class Exercise
{
    public readonly int $id;
    public readonly User $id_usuario;
    public readonly float $peso;
    public readonly int $tempo_descanso;
    public readonly int $repeticao;
    public readonly string $exercicio;
    public readonly string $objetivo;
    public readonly string $dia;
    public readonly string $obs;
    public readonly string $categoria;
    public readonly User $id_personal;

    public readonly string $video;
    public function __construct(
        int $id,
        User $id_usuario,
        float $peso,
        int $tempo_descanso,
        int $repeticao,
        string $exercicio,
        string $objetivo,
        string $dia,
        string $obs,
        string $categoria,
        User $id_personal,
        string $video
    ) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->peso = $peso;
        $this->tempo_descanso = $tempo_descanso;
        $this->repeticao = $repeticao;
        $this->exercicio = $exercicio;
        $this->objetivo = $objetivo;
        $this->categoria = $categoria;
        $this->dia = $dia;
        $this->obs = $obs;
        $this->id_personal = $id_personal;
        $this->video = $video;
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

    public function setTempoDescanso(int $tempo_descanso)
    {
        if ($tempo_descanso < 0) {
            throw new \InvalidArgumentException("Tempo de descanso não pode ser negativo!");
        }
        $this->tempo_descanso = $tempo_descanso;
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

    public function setObjetivo(string $objetivo)
    {
        if (empty($objetivo)) {
            throw new \InvalidArgumentException("Objetivo não pode ser vazio!");
        }
        $this->objetivo = $objetivo;
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

    public function setVideo(string $video)
    {
        if (empty($video)) {
            throw new \InvalidArgumentException("Insira um vídeo!");
        }
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

    public function getTempoDescanso(): int
    {
        return $this->tempo_descanso;
    }

    public function getExercicio(): string
    {
        return $this->exercicio;
    }

    public function getObjetivo(): string
    {
        return $this->objetivo;
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
    public function getVideo(): string
    {
        return $this->video;
    }
}
?>