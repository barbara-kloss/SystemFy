<?php

class User
{
    public readonly int $id;
    public readonly string $nome;
    public readonly string $email;
    public readonly Date $data_nasc;
    public readonly string $genero;
    public readonly string $telefone;
    public readonly string $senha;
    public readonly string $permissao;
    public readonly float $altura;
    public readonly int $peso;
    public readonly bool $status;
    public readonly string $observacao;
    public readonly float $massa;
    public readonly float $gordura;
    public readonly Plano $plano_id;
    public readonly string $objetivo;
    public readonly string $foto;
    public readonly float $peso_meta;

    function __construct(
        int $id, string $nome, Date $data_nasc, string $genero, string $telefone, string $senha, string $permissao, float $altura, int $peso, string $objetivo, bool $status, string $observacao, float $massa, float $gordura, Plano $plano_id, string $email, string $foto, float $peso_meta
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->data_nasc = $data_nasc;
        $this->genero = $genero;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->permissao = $permissao;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->objetivo = $objetivo;
        $this->status = $status;
        $this->observacao = $observacao;
        $this->massa = $massa;
        $this->gordura = $gordura;
        $this->plano_id = $plano_id;
        $this->email = $email;
        $this->foto = $foto;
        $this->peso_meta = $peso_meta;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setDate(Date $data_nasc)
    {
        $this->data_nasc = $data_nasc;
    }

    public function setGenero(string $genero)
    {
        $this->genero = $genero;
    }

    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }

    public function setPermissao(string $permissao)
    {
        $this->permissao = $permissao;
    }

    public function setAltura(float $altura)
    {
        $this->altura = $altura;
    }

    public function setPeso(int $peso)
    {
        $this->peso = $peso;
    }

    public function setStatus(bool $status)
    {
        $this->status = $status;
    }

    public function setObs(string $observacao)
    {
        $this->observacao = $observacao;
    }

    public function setMassa(float $massa)
    {
        $this->massa = $massa;
    }

    public function setGordura(float $gordura)
    {
        $this->gordura = $gordura;
    }

    public function setPlano(Plano $plano_id)
    {
        $this->plano_id = $plano_id;
    }

    public function setObjetivo(string $objetivo)
    {
        $this->objetivo = $objetivo;
    }

    public function setFoto(string $foto)
    {
        $this->foto = $foto;
    }

    public function setPesoMeta(float $peso_meta)
    {
        $this->peso_meta = $peso_meta;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDataNasc(): Date
    {
        return $this->data_nasc;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getPermissao(): string
    {
        return $this->permissao;
    }

    public function getAltura(): float
    {
        return $this->altura;
    }

    public function getPeso(): int
    {
        return $this->peso;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getObservacao(): string
    {
        return $this->observacao;
    }

    public function getMassa(): float
    {
        return $this->massa;
    }

    public function getGordura(): float
    {
        return $this->gordura;
    }

    public function getPlanoId(): Plano
    {
        return $this->plano_id;
    }

    public function getObjetivo(): string
    {
        return $this->objetivo;
    }

    public function getFoto(): string
    {
        return $this->foto;
    }
    public function getPesoMeta(): float
    {
        return $this->peso_meta;
    }
}

?>