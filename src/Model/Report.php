<?php
use User;
use Plano;
class Report
{
    public readonly int $id;
    public readonly Date $data;
    public readonly User $personal_id;
    public readonly User $nutri_id;

    public readonly User $objetivo;

    public readonly User $user;

    public readonly Plano $plano;

    public function __construct(int $id,
    User $user, User $personal_id, User $nutri_id,
        Date $data, User $objetivo, Plano $plano)
    {
        $this->id = $id;
        $this->user = $user;
        $this->personal_id = $personal_id;
        $this->nutri_id = $nutri_id;
        $this->data = $data;
        $this->objetivo = $objetivo;
        $this->plano = $plano;
    }

    public function setId(int $id)
    {
        $this->id = $id;
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


    public function setObjetivo(User $objetivo)
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

    public function getObjetivo(): User
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