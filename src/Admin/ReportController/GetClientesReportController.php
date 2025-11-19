<?php

namespace Systemfy\App\Admin\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;
use PDO;

class GetClientesReportController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        try {
            $pdo = Database::getConnection();
            
            // Buscar todos os clientes ativos com seus planos
            $sql = "SELECT 
                        u.id,
                        u.nome_completo,
                        u.email,
                        u.status,
                        u.telefone,
                        p.categoria as plano_categoria,
                        p.preco as plano_preco
                    FROM user u
                    LEFT JOIN plano p ON u.plano_id = p.id
                    WHERE u.permissao = 'cliente'
                    ORDER BY u.nome_completo";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Formatar dados para o relatório
            $dados = [];
            foreach ($clientes as $cliente) {
                $dados[] = [
                    'id' => $cliente['id'],
                    'nome' => $cliente['nome_completo'] ?? 'Sem nome',
                    'status' => $cliente['status'] == 1 ? 'Ativo' : 'Inativo',
                    'valor' => $cliente['plano_preco'] ? 'R$ ' . number_format($cliente['plano_preco'], 2, ',', '.') : 'R$ 0,00',
                    'plano' => $cliente['plano_categoria'] ?? 'Sem plano'
                ];
            }
            
            echo json_encode([
                'success' => true,
                'data' => $dados,
                'total' => count($dados),
                'ativos' => count(array_filter($dados, fn($c) => $c['status'] === 'Ativo'))
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}

