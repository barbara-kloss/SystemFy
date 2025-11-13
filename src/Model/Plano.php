<?php
class Plano
{
    public readonly int $id;
    public readonly string $categoria;
    public readonly float $preco;
    public readonly string $descricao;
    public readonly bool $ativo;

    public function __construct(int $id, string $categoria, float $preco, string $descricao, bool $ativo)
    {
        $this->id = $id;
        $this->categoria = $categoria;
        $this->preco = $preco;
        $this->descricao = $descricao;
        $this->ativo = $ativo;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setCategoria(string $categoria)
    {
        $this->categoria = $categoria;
    }

    public function setPreco(float $preco)
    {
        $this->preco = $preco;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function setAtivo(bool $ativo)
    {
        $this->ativo = $ativo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function getAtivo(): bool
    {
        return $this->ativo;
    }
}
?>