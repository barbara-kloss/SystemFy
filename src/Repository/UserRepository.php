<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\config\database;
use Systemfy\App\Model\User;
class UserRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = database::getConnection();
    }

    public function add(User $user) : bool
    {
        $hash = password_hash($user->senha, PASSWORD_ARGON2ID);

        $sql = "INSERT INTO user( 
        nome_completo, data_nascimento, genero, 
        telefone, senha, permissao, 
        altura, peso, objetivos, status, observacao,
        massa, gordura, plano_id, email, foto, peso_meta) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $user->nome_completo);
        $stmt->bindValue(2, $user->data_nascimento);
        $stmt->bindValue(3, $user->genero);
        $stmt->bindValue(4, $user->telefone);
        $stmt->bindValue(5, $hash);
        $stmt->bindValue(6, $user->permissao);
        $stmt->bindValue(7, $user->altura);
        $stmt->bindValue(8, $user->peso);
        $stmt->bindValue(9, $user->objetivos);
        $stmt->bindValue(10, $user->status);
        $stmt->bindValue(11, $user->observacao);
        $stmt->bindValue(12, $user->massa);
        $stmt->bindValue(13, $user->gordura);
        $stmt->bindValue(14, $user->plano_id);
        $stmt->bindValue(15, $user->email);
        $stmt->bindValue(16, $user->foto);
        $stmt->bindValue(17, $user->peso_meta);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $user->setId(intval($id));
        return $result;
    }
    public function update(User $user): bool
    {
        $sql = 'UPDATE user SET nome_completo = :nome_completo, 
        data_nascimento= :data_nascimento, genero= :genero,
        telefone = :telefone, senha = :senha, 
        altura = :altura, peso = :peso, objetivos = :objetivos,
        status = :status, observacao = :observacao,
        massa = :massa, gordura = :gordura, plano_id = :plano_id, email = :email, foto = :foto, peso_meta = :peso_meta
        WHERE id = :id;'; // sem mudança de permissao
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome_completo', $user->nome_completo);
        $stmt->bindValue(':data_nascimento', $user->data_nascimento);
        $stmt->bindValue(':genero', $user->genero);
        $stmt->bindValue(':telefone', $user->telefone);
        $stmt->bindValue(':senha', $user->senha);
        $stmt->bindValue(':altura', $user->altura);
        $stmt->bindValue(':peso', $user->peso);
        $stmt->bindValue(':objetivos', $user->objetivos);
        $stmt->bindValue(':status', $user->status);
        $stmt->bindValue(':observacao', $user->observacao);
        $stmt->bindValue(':massa', $user->massa);
        $stmt->bindValue(':gordura', $user->gordura);
        $stmt->bindValue(':plano_id', $user->plano_id);
        $stmt->bindValue(':email', $user->email);
        $stmt->bindValue(':foto', $user->foto);
        $stmt->bindValue(':peso_meta', $user->peso_meta);
        $stmt->bindValue(':id', $user->id);

        return $stmt->execute();
    }

    public function all(): array
    {
        $userList = $this->pdo
            ->query('SELECT * FROM user;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateUser(...),
            $userList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateUser($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateUser(array $UserData): User
    {
        $user = new User($UserData['nome_completo'],
            $UserData['data_nascimento'],
            $UserData['genero'],
            $UserData['telefone'],
            $UserData['senha'],
            $UserData['permissao'],
            $UserData['altura'],
            $UserData['peso'],
            $UserData['objetivos'],
            $UserData['status'],
            $UserData['observacao'],
            $UserData['massa'],
            $UserData['gordura'],
            $UserData['plano_id'],
            $UserData['email'],
         $UserData['foto'],
         $UserData['peso_meta']);
        $user->setId($UserData['id']);
        return $user;
    }


}

