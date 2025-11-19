<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Database;
use Systemfy\App\Model\User;
use Systemfy\App\Model\Date;
use Systemfy\App\Model\Plano;
use Systemfy\App\Repository\PlanoRepository;

class UserRepository
{
    private PDO $pdo;
    private ?PlanoRepository $planoRepository;
    private ?string $lastError = null;
    
    function __construct(?PlanoRepository $planoRepository = null)
    {
        $this->pdo = database::getConnection();
        $this->planoRepository = $planoRepository;
    }
    
    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    public function add(User $user) : bool
    {
        try {
            $this->lastError = null;
            
            $hash = password_hash($user->getSenha(), PASSWORD_ARGON2ID);
            
            $planoId = $user->getPlanoId();
            $planoIdValue = $planoId ? $planoId->getId() : null;

            $sql = "INSERT INTO user( 
            nome_completo, data_nascimento, genero, 
            telefone, senha, permissao, 
            altura, peso, objetivos, status, observacao,
            massa, gordura, plano_id, email, foto, peso_meta) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $stmt = $this->pdo->prepare($sql);
            if ($stmt === false) {
                $this->lastError = 'Erro ao preparar SQL: ' . implode(', ', $this->pdo->errorInfo());
                return false;
            }
            
            $stmt->bindValue(1, $user->getNome() ?: null);
            $dataNasc = $user->getDataNasc()->getDate();
            $stmt->bindValue(2, ($dataNasc && $dataNasc !== '0000-00-00') ? $dataNasc : null);
            $stmt->bindValue(3, $user->getGenero() ?: null);
            $stmt->bindValue(4, $user->getTelefone() ?: null);
            $stmt->bindValue(5, $hash);
            $stmt->bindValue(6, $user->getPermissao() ?: 'cliente');
            $altura = $user->getAltura();
            $stmt->bindValue(7, ($altura > 0) ? $altura : null, \PDO::PARAM_STR);
            $peso = $user->getPeso();
            $stmt->bindValue(8, ($peso > 0) ? $peso : null, \PDO::PARAM_INT);
            $stmt->bindValue(9, $user->getObjetivo() ?: null);
            $stmt->bindValue(10, $user->getStatus() ? 1 : 0, \PDO::PARAM_INT);
            $stmt->bindValue(11, $user->getObservacao() ?: null);
            $massa = $user->getMassa();
            $stmt->bindValue(12, ($massa > 0) ? $massa : null, \PDO::PARAM_STR);
            $gordura = $user->getGordura();
            $stmt->bindValue(13, ($gordura > 0) ? $gordura : null, \PDO::PARAM_STR);
            $stmt->bindValue(14, $planoIdValue, \PDO::PARAM_INT);
            $stmt->bindValue(15, $user->getEmail() ?: null);
            $stmt->bindValue(16, $user->getFoto() ?: null);
            $pesoMeta = $user->getPesoMeta();
            $stmt->bindValue(17, ($pesoMeta > 0) ? $pesoMeta : null, \PDO::PARAM_STR);

            $result = $stmt->execute();
            
            if ($result === false) {
                $errorInfo = $stmt->errorInfo();
                $this->lastError = 'Erro ao executar SQL: ' . ($errorInfo[2] ?? 'Erro desconhecido') . ' | Código: ' . ($errorInfo[0] ?? 'N/A');
                return false;
            }
            
            $id = $this->pdo->lastInsertId();
            if ($id) {
                $user->setId(intval($id));
            }
            
            return $result;
        } catch (\PDOException $e) {
            $this->lastError = 'PDO Exception: ' . $e->getMessage() . ' | Código: ' . $e->getCode();
            return false;
        } catch (\Exception $e) {
            $this->lastError = 'Exception: ' . $e->getMessage() . ' | Linha: ' . $e->getLine();
            return false;
        }
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
        
        $planoId = $user->getPlanoId();
        $planoIdValue = $planoId ? $planoId->getId() : null;
        
        // Fazer hash da senha se ela foi alterada (não está em hash)
        $senha = $user->getSenha();
        if (!empty($senha)) {
            $senhaInfo = @password_get_info($senha);
            // Se não é um hash válido (algo é null ou false), fazer hash
            if (!isset($senhaInfo['algo']) || $senhaInfo['algo'] === false || $senhaInfo['algo'] === null) {
                $senha = password_hash($senha, PASSWORD_ARGON2ID);
            }
        }
        
        $stmt->bindValue(':nome_completo', $user->getNome());
        $stmt->bindValue(':data_nascimento', $user->getDataNasc()->getDate());
        $stmt->bindValue(':genero', $user->getGenero());
        $stmt->bindValue(':telefone', $user->getTelefone());
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':altura', $user->getAltura());
        $stmt->bindValue(':peso', $user->getPeso());
        $stmt->bindValue(':objetivos', $user->getObjetivo());
        $stmt->bindValue(':status', $user->getStatus() ? 1 : 0, \PDO::PARAM_INT);
        $stmt->bindValue(':observacao', $user->getObservacao());
        $stmt->bindValue(':massa', $user->getMassa());
        $stmt->bindValue(':gordura', $user->getGordura());
        $stmt->bindValue(':plano_id', $planoIdValue);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':foto', $user->getFoto());
        $stmt->bindValue(':peso_meta', $user->getPesoMeta());
        $stmt->bindValue(':id', $user->getId());

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
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = ?;');
            $stmt->bindValue(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$userData || empty($userData)) {
                return null;
            }

            return $this->hydrateUser($userData);
        } catch (\Throwable $e) {
            error_log("Erro no UserRepository::find: " . $e->getMessage());
            return null;
        }
    }

    public function hydrateUser(array $UserData): User
    {
        // Verificar se os dados são válidos
        if (empty($UserData) || !isset($UserData['id']) || $UserData['id'] === null) {
            throw new \InvalidArgumentException('Invalid user data provided to hydrateUser: id is missing or null');
        }
        
        // Garantir valores padrão para campos que podem ser null
        $id = (int) $UserData['id'];
        $nome = $UserData['nome_completo'] ?? '';
        
        // Handle Date object - create from string or use default
        $data_nasc_str = $UserData['data_nascimento'] ?? '0000-00-00';
        $data_nasc = new Date($data_nasc_str);
        
        $genero = $UserData['genero'] ?? '';
        $telefone = $UserData['telefone'] ?? '';
        $senha = $UserData['senha'] ?? '';
        $permissao = $UserData['permissao'] ?? 'cliente';
        $altura = isset($UserData['altura']) && $UserData['altura'] !== null ? (float) $UserData['altura'] : 0.0;
        $peso = isset($UserData['peso']) && $UserData['peso'] !== null ? (int) $UserData['peso'] : 0;
        $objetivo = $UserData['objetivos'] ?? '';
        $status = isset($UserData['status']) ? (bool) $UserData['status'] : false;
        $observacao = $UserData['observacao'] ?? '';
        $massa = isset($UserData['massa']) && $UserData['massa'] !== null ? (float) $UserData['massa'] : 0.0;
        $gordura = isset($UserData['gordura']) && $UserData['gordura'] !== null ? (float) $UserData['gordura'] : 0.0;
        
        // Handle Plano object - fetch from repository if plano_id exists
        $plano_id_raw = $UserData['plano_id'] ?? null;
        $plano_id = null;
        if ($plano_id_raw !== null && $this->planoRepository !== null) {
            $plano = $this->planoRepository->find((int) $plano_id_raw);
            $plano_id = $plano; // Can be null if not found
        }
        
        $email = $UserData['email'] ?? '';
        $foto = $UserData['foto'] ?? '';
        $peso_meta = isset($UserData['peso_meta']) && $UserData['peso_meta'] !== null ? (float) $UserData['peso_meta'] : 0.0;
        
        $user = new User(
            $id,
            $nome,
            $data_nasc,
            $genero,
            $telefone,
            $senha,
            $permissao,
            $altura,
            $peso,
            $objetivo,
            $status,
            $observacao,
            $massa,
            $gordura,
            $plano_id,
            $email,
            $foto,
            $peso_meta
        );
        return $user;
    }

    public function countActiveClients(): int
    {
        try {
            $sql = "SELECT COUNT(*) as total 
                    FROM user 
                    WHERE permissao = 'cliente' 
                    AND status = 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return (int) ($result['total'] ?? 0);
        } catch (\Exception $e) {
            return 0;
        }
    }


}

