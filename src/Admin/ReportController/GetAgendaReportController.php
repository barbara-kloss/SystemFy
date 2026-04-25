<?php

namespace Systemfy\App\Admin\ReportController;

use PDO;
use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;

class GetAgendaReportController implements Controller
{
    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');

        try {
            $pdo = Database::getConnection();

            $sql = "SELECT
                        a.id,
                        a.titulo,
                        a.assunto,
                        a.data_reuniao,
                        a.horario,
                        u.nome_completo
                    FROM agenda a
                    LEFT JOIN user u ON u.id = a.id_user
                    ORDER BY a.data_reuniao DESC, a.horario DESC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dados = array_map(static function (array $item): array {
                $nome = $item['titulo'] ?: ($item['nome_completo'] ?: 'Sem titulo');
                $assunto = trim((string) ($item['assunto'] ?? ''));
                $dataBr = '';

                if (!empty($item['data_reuniao'])) {
                    $timestamp = strtotime($item['data_reuniao']);
                    if ($timestamp !== false) {
                        $dataBr = date('d/m/Y', $timestamp);
                    }
                }

                $valor = trim($dataBr . ' ' . ($item['horario'] ?? ''));

                return [
                    'id' => $item['id'],
                    'nome' => $nome,
                    'status' => $assunto !== '' ? $assunto : 'Agendado',
                    'valor' => $valor,
                    'data_raw' => $item['data_reuniao'] ?? null,
                    'cliente' => $item['nome_completo'] ?? ''
                ];
            }, $agendamentos);

            echo json_encode([
                'success' => true,
                'data' => $dados,
                'total' => count($dados)
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
