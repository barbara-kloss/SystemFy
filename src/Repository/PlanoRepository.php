<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Model\Plano;
class PlanoRepository
{
    function __construct(private PDO $pdo)
    {
    }

    public function add(Plano $plano) : bool
    {
        $sql = "INSERT INTO plano(categoria, preco, descricao, ativo) values(?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $plano->categoria);
        $stmt->bindValue(2, $plano->preco);
        $stmt->bindValue(3, $plano->descricao);
        $stmt->bindValue(4, $plano->ativo);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $plano->setId(intval($id));
        return $result;
    }
//    public function remove(int $id): bool
//    {
//        $sql = 'DELETE FROM plano WHERE id = ?';
//        $stmt = $this->pdo->prepare($sql);
//        $stmt->bindValue(1, $id);
//
//        return $stmt->execute();
//
//    }

    public function update(Plano $plano): bool
    {
        $sql = 'UPDATE plano SET categoria = :categoria, 
        preco = :preco, descricao = :descricao, ativo = :ativo  WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':categoria', $plano->categoria);
        $stmt->bindValue(':preco', $plano->preco);
        $stmt->bindValue(':descricao', $plano->descricao);
        $stmt->bindValue(':ativo', $plano->ativo);
        $stmt->bindValue(':id', $plano->id);

        return $stmt->execute();
    }

    public function all(): array
    {
        $planoList = $this->pdo
            ->query('SELECT * FROM plano;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydratePlano(...),
            $planoList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM plano WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydratePlano($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydratePlano(array $PlanoData): Plano
    {
        $plano = new Plano($PlanoData['categoria'],
            $PlanoData['preco'],
            $PlanoData['descricao'],
            $PlanoData['ativo']);
        $plano->setId($PlanoData['id']);
        return $plano;
    }


}

