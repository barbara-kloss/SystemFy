<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;
use PDO;

class BuscaClienteCompletoController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        
        $termo = $_GET['q'] ?? '';
        $termo = trim($termo);
        
        if (strlen($termo) < 2) {
            echo json_encode([]);
            return;
        }

        try {
            $pdo = Database::getConnection();
            
            // Primeiro, vamos verificar se há clientes no banco (para debug)
            $sqlCount = "SELECT COUNT(*) as total FROM user WHERE permissao = 'cliente'";
            $stmtCount = $pdo->query($sqlCount);
            $totalClientes = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
            
            // Buscar clientes
            $sql = "SELECT id, nome_completo, email 
                    FROM user 
                    WHERE permissao = 'cliente' 
                    AND (nome_completo LIKE ? OR email LIKE ?) 
                    ORDER BY nome_completo ASC
                    LIMIT 10";
            
            $stmt = $pdo->prepare($sql);
            $termoLike = "%{$termo}%";
            $stmt->bindValue(1, $termoLike, PDO::PARAM_STR);
            $stmt->bindValue(2, $termoLike, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Garantir que não há valores null e converter para UTF-8
            foreach ($resultados as &$resultado) {
                $resultado['id'] = (int) $resultado['id'];
                $resultado['nome_completo'] = $resultado['nome_completo'] ?? '';
                $resultado['email'] = $resultado['email'] ?? '';
            }
            
            // Retornar resultados
            echo json_encode($resultados, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }
    }
}

