<?php
use User;
use Plano;
namespace Systemfy\App\Model;
class Report
{
    private int $id;
    private Date $data;
    private User $personal_id;
    private User $nutri_id;

    private User $objetivo;

    private User $user;

    private Plano $plano;

    public function __construct(
    User $user, User $personal_id, User $nutri_id,
        Date $data, User $objetivo, Plano $plano)
    {
        
        $this->user = $user;
        $this->personal_id = $personal_id;
        $this->nutri_id = $nutri_id;
        $this->data = $data;
        $this->objetivo = $objetivo;
        $this->plano = $plano;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function setData(Date $data) : void
    {
        $this->data = $data;
    }

    public function setPersonalId(User $personal_id) : void
    {
        $this->personal_id = $personal_id;
    }

    public function setNutriId(User $nutri_id) : void
    {
        $this->nutri_id = $nutri_id;
    }


    public function setObjetivo(User $objetivo) : void
    {
        $this->objetivo = $objetivo;
    }

    public function setUser(User $user) : void
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