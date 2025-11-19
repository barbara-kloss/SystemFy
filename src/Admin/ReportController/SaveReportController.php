<?php

namespace Systemfy\App\Admin\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;
use PDO;

class SaveReportController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Método não permitido']);
            return;
        }
        
        // Iniciar sessão se não estiver iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $input = $_POST;
            }
            
            $tipo = $input['tipo'] ?? '';
            $dados = $input['dados'] ?? [];
            $formato = $input['formato'] ?? '';
            
            if (empty($tipo) || empty($dados)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
                return;
            }
            
            $pdo = Database::getConnection();
            
            // Verificar se a tabela tem campos para tipo_relatorio e dados_json
            // Se não tiver, usar a estrutura existente adaptada
            // Vamos tentar inserir com campos flexíveis
            $dadosJson = json_encode($dados);
            $userId = $_SESSION['user_id'] ?? null;
            $dataAtual = date('Y-m-d');
            
            // Tentar inserir com estrutura nova (tipo_relatorio, dados_json, formato, data_geracao)
            // Se falhar, usar estrutura antiga
            try {
                $sql = "INSERT INTO report (
                            tipo_relatorio,
                            dados_json,
                            formato,
                            data_geracao,
                            id_user
                        ) VALUES (?, ?, ?, NOW(), ?)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $tipo, PDO::PARAM_STR);
                $stmt->bindValue(2, $dadosJson, PDO::PARAM_STR);
                $stmt->bindValue(3, $formato, PDO::PARAM_STR);
                $stmt->bindValue(4, $userId, PDO::PARAM_INT);
                
                $result = $stmt->execute();
            } catch (\Exception $e) {
                // Se falhar, tentar com estrutura antiga usando campo 'objetivo' para salvar JSON
                $sql = "INSERT INTO report (
                            id_user,
                            id_personal,
                            id_nutri,
                            dia,
                            objetivo,
                            plano
                        ) VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $userId, PDO::PARAM_INT);
                $stmt->bindValue(2, null, PDO::PARAM_NULL);
                $stmt->bindValue(3, null, PDO::PARAM_NULL);
                $stmt->bindValue(4, $dataAtual, PDO::PARAM_STR);
                // Salvar tipo e dados JSON no campo objetivo
                $objetivo = $tipo . '|' . $formato . '|' . $dadosJson;
                $stmt->bindValue(5, $objetivo, PDO::PARAM_STR);
                $stmt->bindValue(6, null, PDO::PARAM_NULL);
                
                $result = $stmt->execute();
            }
            
            if ($result) {
                $id = $pdo->lastInsertId();
                echo json_encode([
                    'success' => true,
                    'message' => 'Relatório salvo com sucesso',
                    'id' => $id
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'error' => 'Erro ao salvar relatório'
                ]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}

