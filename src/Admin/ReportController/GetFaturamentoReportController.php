<?php

namespace Systemfy\App\Admin\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;
use PDO;

class GetFaturamentoReportController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        try {
            $pdo = Database::getConnection();
            
            // Calcular faturamento mensal (clientes ativos com planos)
            $sqlMensal = "SELECT 
                            COALESCE(SUM(p.preco), 0) as total_mensal,
                            COUNT(DISTINCT u.id) as total_clientes
                         FROM user u
                         LEFT JOIN plano p ON u.plano_id = p.id
                         WHERE u.permissao = 'cliente' 
                         AND u.status = 1";
            
            $stmtMensal = $pdo->prepare($sqlMensal);
            $stmtMensal->execute();
            $faturamentoMensal = $stmtMensal->fetch(PDO::FETCH_ASSOC);
            
            $totalMensal = (float) ($faturamentoMensal['total_mensal'] ?? 0);
            $totalAnual = $totalMensal * 12;
            
            // Buscar faturamento por plano
            $sqlPorPlano = "SELECT 
                              p.categoria,
                              p.preco,
                              COUNT(u.id) as qtd_clientes,
                              (p.preco * COUNT(u.id)) as total_plano
                            FROM plano p
                            LEFT JOIN user u ON u.plano_id = p.id AND u.status = 1 AND u.permissao = 'cliente'
                            WHERE p.ativo = 1
                            GROUP BY p.id, p.categoria, p.preco
                            ORDER BY total_plano DESC";
            
            $stmtPorPlano = $pdo->prepare($sqlPorPlano);
            $stmtPorPlano->execute();
            $porPlano = $stmtPorPlano->fetchAll(PDO::FETCH_ASSOC);
            
            // Organizar dados em seções
            $dados = [
                // Resumo Geral
                [
                    'tipo' => 'RESUMO GERAL',
                    'descricao' => 'Total de ' . ($faturamentoMensal['total_clientes'] ?? 0) . ' clientes ativos',
                    'status' => '',
                    'valor' => '',
                    'isHeader' => true
                ],
                [
                    'tipo' => 'Mensal Previsto',
                    'descricao' => 'Faturamento mensal estimado',
                    'status' => 'Ativo',
                    'valor' => 'R$ ' . number_format($totalMensal, 2, ',', '.')
                ],
                [
                    'tipo' => 'Anual (Estimado)',
                    'descricao' => 'Projeção baseada no\nfaturamento mensal',
                    'status' => '',
                    'valor' => 'R$ ' . number_format($totalAnual, 2, ',', '.')
                ],
                // Separador
                [
                    'tipo' => '',
                    'descricao' => '',
                    'status' => '',
                    'valor' => '',
                    'isSeparator' => true
                ],
                // Detalhamento por Plano
                [
                    'tipo' => 'DETALHAMENTO POR PLANO',
                    'descricao' => '',
                    'status' => '',
                    'valor' => '',
                    'isHeader' => true
                ]
            ];
            
            // Adicionar detalhes por plano
            foreach ($porPlano as $plano) {
                if ($plano['qtd_clientes'] > 0) {
                    $dados[] = [
                        'tipo' => $plano['categoria'],
                        'descricao' => $plano['qtd_clientes'] . ' cliente(s) ativo(s)\nValor unitário: R$ ' . number_format($plano['preco'], 2, ',', '.'),
                        'status' => 'Ativo',
                        'valor' => 'R$ ' . number_format($plano['total_plano'], 2, ',', '.')
                    ];
                }
            }
            
            echo json_encode([
                'success' => true,
                'data' => $dados,
                'total_mensal' => $totalMensal,
                'total_anual' => $totalAnual,
                'total_clientes' => (int) ($faturamentoMensal['total_clientes'] ?? 0)
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

