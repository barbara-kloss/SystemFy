<?php
use User;
use Plano;
class Report
{
    public readonly int $id;
    public readonly string $anotacao;
    public readonly Date $data;
    public readonly User $personal_id;
    public readonly User $nutri_id;
    public readonly bool $exe_feito;
    public readonly string $objetivo;
    public readonly User $user;
    public readonly Plano $plano;

    public function __construct(int $id, string $anotacao, Date $data, User $personal_id, User $nutri_id, bool $exe_feito, string $objetivo, User $user, Plano $plano)
    {
        $this->id = $id;
        $this->anotacao = $anotacao;
        $this->data = $data;
        $this->personal_id = $personal_id;
        $this->nutri_id = $nutri_id;
        $this->exe_feito = $exe_feito;
        $this->objetivo = $objetivo;
        $this->user = $user;
        $this->plano = $plano;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setAnotacao(string $anotacao)
    {
        $this->anotacao = $anotacao;
    }

    public function setData(Date $data)
    {
        $this->data = $data;
    }

    public function setPersonalId(User $personal_id)
    {
        $this->personal_id = $personal_id;
    }

    public function setNutriId(User $nutri_id)
    {
        $this->nutri_id = $nutri_id;
    }

    public function setExeFeito(bool $exe_feito)
    {
        $this->exe_feito = $exe_feito;
    }

    public function setObjetivo(string $objetivo)
    {
        $this->objetivo = $objetivo;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setPlano(Plano $plano)
    {
        $this->plano = $plano;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAnotacao(): string
    {
        return $this->anotacao;
    }

    public function getData(): Date
    {
        return $this->data;
    }

    public function getPersonalId(): User
    {
        return $this->personal_id;
    }

    public function getNutriId(): User
    {
        return $this->nutri_id;
    }

    public function getExeFeito(): bool
    {
        return $this->exe_feito;
    }

    public function getObjetivo(): string
    {
        return $this->objetivo;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPlano(): Plano
    {
        return $this->plano;
    }
}

?>