
<?php

class User {
    public readonly int $id;
    public readonly String $nome;
    public readonly String $email;
    public readonly Date $data_nasc;
    public readonly String $genero;
    public readonly String $telefone;
    public readonly String $senha;
    public readonly String $permissao;
    public readonly float $altura;
    public readonly int $peso;
    public readonly bool $status;
    public readonly String $observacao;
    public readonly float $massa;
    public readonly float $gordura;
    public readonly Plano $plano_id;
    public readonly String $objetivo;

    function __construct(
        int $id,
        String $nome,
        String $email,
        Date $data_nasc,
        String $genero,
        String $telefone,
        String $senha,
        String $permissao,
        float $altura,
        int $peso,
        bool $status,
        String $observacao,
        float $massa,
        string $objetivo,
        float $gordura,
        Plano $plano_id
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->data_nasc = $data_nasc;
        $this->genero = $genero;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->permissao = $permissao;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->status = $status;
        $this->observacao = $observacao;
        $this->objetivo = $objetivo;
        $this->gordura = $gordura;
        $this->plano_id = $plano_id;
        $this->massa = $massa;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setSenha(string $senha) {
        $this->senha = $senha;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setDate(Date $data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    public function setGenero(String $genero) {
        $this->genero = $genero;
    }

    public function setTelefone(String $telefone) {
        $this->telefone = $telefone;
    }

    public function setPermissao(String $permissao) {
        $this->permissao = $permissao;
    }

    public function setAltura(float $altura) {
        $this->altura = $altura;
    }

    public function setPeso(int $peso) {
        $this->peso = $peso;
    }

    public function setStatus(bool $status) {
        $this->status = $status;
    }

    public function setObs(String $observacao) {
        $this->observacao = $observacao;
    }

    public function setMassa(float $massa) {
        $this->massa = $massa;
    }

    public function setGordura(float $gordura) {
        $this->gordura = $gordura;
    }

    public function setPlano(Plano $plano_id) {
        $this->plano_id = $plano_id;
    }

    public function setObjetivo(String $objetivo) {
        $this->objetivo = $objetivo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getDataNasc(): Date {
        return $this->data_nasc;
    }

    public function getGenero(): string {
        return $this->genero;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getSenha(): string {
        return $this->senha;
    }

    public function getPermissao(): string {
        return $this->permissao;
    }

    public function getAltura(): float {
        return $this->altura;
    }

    public function getPeso(): int {
        return $this->peso;
    }

    public function getStatus(): bool {
        return $this->status;
    }

    public function getObservacao(): string {
        return $this->observacao;
    }

    public function getMassa(): float {
        return $this->massa;
    }

    public function getGordura(): float {
        return $this->gordura;
    }

    public function getPlanoId(): Plano {
        return $this->plano_id;
    }

    public function getObjetivo(): string {
        return $this->objetivo;
    }
}

?>