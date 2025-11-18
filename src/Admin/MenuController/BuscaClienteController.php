<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;
use PDO;

class BuscaClienteController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
        
        if (strlen($termo) < 2) {
            echo json_encode([]);
            return;
        }

        try {
            $pdo = Database::getConnection();
            $sql = "SELECT id, nome_completo, email 
                    FROM user 
                    WHERE permissao = 'cliente' 
                    AND (nome_completo LIKE ? OR email LIKE ?) 
                    LIMIT 10";
            
            $stmt = $pdo->prepare($sql);
            $termoLike = "%{$termo}%";
            $stmt->bindValue(1, $termoLike, PDO::PARAM_STR);
            $stmt->bindValue(2, $termoLike, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Garantir que não há valores null
            foreach ($resultados as &$resultado) {
                $resultado['nome_completo'] = $resultado['nome_completo'] ?? '';
                $resultado['email'] = $resultado['email'] ?? '';
            }
            echo json_encode($resultados);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

