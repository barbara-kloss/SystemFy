<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Database;
use Systemfy\App\Model\Checkin;

class CheckinRepository
{
    private PDO $pdo;
    
    function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function add(Checkin $checkin): bool
    {
        $sql = "INSERT INTO checkin (id_user, id_exercise, categoria, data_checkin) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $checkin->getIdUser(), PDO::PARAM_INT);
        $stmt->bindValue(2, $checkin->getIdExercise(), PDO::PARAM_INT);
        $stmt->bindValue(3, $checkin->getCategoria(), PDO::PARAM_STR);
        $stmt->bindValue(4, $checkin->getDataCheckin(), PDO::PARAM_STR);
        
        $result = $stmt->execute();
        if ($result) {
            $id = $this->pdo->lastInsertId();
            $checkin->setId(intval($id));
        }
        return $result;
    }

    public function findRecent(int $limit = 10): array
    {
        try {
            $sql = "SELECT c.id, c.id_user, c.id_exercise, c.categoria, c.data_checkin,
                           u.nome_completo as nome_cliente
                    FROM checkin c
                    INNER JOIN user u ON c.id_user = u.id
                    WHERE u.permissao = 'cliente'
                    ORDER BY c.data_checkin DESC, c.id DESC
                    LIMIT ?";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Garantir que não há valores null ou vazios
            foreach ($resultados as &$resultado) {
                // Se nome_cliente for null ou string vazia, usar 'Cliente'
                $nomeCliente = trim($resultado['nome_cliente'] ?? '');
                $resultado['nome_cliente'] = !empty($nomeCliente) ? $nomeCliente : 'Cliente';
                
                // Se categoria for null ou string vazia, usar 'Treino'
                $categoria = trim($resultado['categoria'] ?? '');
                $resultado['categoria'] = !empty($categoria) ? $categoria : 'Treino';
            }
            
            return $resultados;
        } catch (\Exception $e) {
            // Se a tabela não existir, retornar array vazio
            return [];
        }
    }

    public function findByUserAndExercise(int $id_user, int $id_exercise, string $data): ?Checkin
    {
        try {
            // Usar DATE() em ambos os lados para garantir comparação correta
            $sql = "SELECT * FROM checkin 
                    WHERE id_user = ? AND id_exercise = ? AND DATE(data_checkin) = DATE(?)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
            $stmt->bindValue(2, $id_exercise, PDO::PARAM_INT);
            $stmt->bindValue(3, $data, PDO::PARAM_STR);
            $stmt->execute();
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) {
                return null;
            }
            
            return $this->hydrateCheckin($data);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Busca todos os check-ins do usuário para hoje
     * Retorna array com IDs dos exercícios que têm check-in hoje
     */
    public function findTodayByUser(int $id_user): array
    {
        try {
            // Usar DATE() para garantir comparação correta independente do horário
            $sql = "SELECT id_exercise FROM checkin 
                    WHERE id_user = ? AND DATE(data_checkin) = DATE(NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultados = $stmt->fetchAll(PDO::FETCH_COLUMN);
            // Garantir que todos os valores são inteiros
            $checkins = [];
            foreach ($resultados as $resultado) {
                $checkins[] = (int)$resultado;
            }
            return $checkins;
        } catch (\Exception $e) {
            // Em caso de erro, retornar array vazio
            error_log("Erro ao buscar check-ins: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Remove check-in do usuário para um exercício hoje
     */
    public function removeTodayByUserAndExercise(int $id_user, int $id_exercise): bool
    {
        try {
            $sql = "DELETE FROM checkin 
                    WHERE id_user = ? AND id_exercise = ? AND DATE(data_checkin) = CURDATE()";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
            $stmt->bindValue(2, $id_exercise, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (\Exception $e) {
            return false;
        }
    }

    private function hydrateCheckin(array $data): Checkin
    {
        $checkin = new Checkin(
            (int) $data['id_user'],
            (int) $data['id_exercise'],
            $data['categoria'],
            $data['data_checkin'],
            isset($data['id']) ? (int) $data['id'] : null
        );
        return $checkin;
    }
}

