<?php

namespace Systemfy\App\Client\ClientExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\CheckinRepository;
use Systemfy\App\Repository\ExerciseRepository;
use Systemfy\App\Model\Checkin;

class ClientCheckinController implements Controller
{
    function __construct(
        private CheckinRepository $checkinRepository,
        private ExerciseRepository $exerciseRepository
    ) {}

    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            return;
        }

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Usuário não autenticado']);
            return;
        }

        $id_exercise = filter_input(INPUT_POST, 'id_exercise', FILTER_VALIDATE_INT);
        if (!$id_exercise) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do exercício inválido']);
            return;
        }

        // Verificar se é para remover check-in (quando desmarcar)
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'add';
        
        if ($action === 'remove') {
            // Remover check-in
            $result = $this->checkinRepository->removeTodayByUserAndExercise(
                (int) $userId,
                $id_exercise
            );
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Check-in removido com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao remover check-in']);
            }
            return;
        }

        // Buscar exercício para obter a categoria
        $exercise = $this->exerciseRepository->find($id_exercise);
        if (!$exercise) {
            http_response_code(404);
            echo json_encode(['error' => 'Exercício não encontrado']);
            return;
        }

        // Verificar se o exercício pertence ao usuário
        if ($exercise->id_user != $userId) {
            http_response_code(403);
            echo json_encode(['error' => 'Exercício não pertence ao usuário']);
            return;
        }

        $categoria = $exercise->categoria ?? 'Outros';
        // Usar data atual do MySQL para garantir consistência
        $data_checkin = date('Y-m-d H:i:s');

        // Verificar se já existe check-in hoje para este exercício
        $checkinExistente = $this->checkinRepository->findByUserAndExercise(
            (int) $userId,
            $id_exercise,
            $data_checkin
        );

        if ($checkinExistente) {
            // Já existe check-in, retornar sucesso
            echo json_encode(['success' => true, 'message' => 'Check-in já registrado']);
            return;
        }

        // Criar novo check-in
        try {
            $checkin = new Checkin(
                (int) $userId,
                $id_exercise,
                $categoria,
                $data_checkin
            );

            $result = $this->checkinRepository->add($checkin);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Check-in registrado com sucesso']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao registrar check-in no banco de dados. Verifique se a tabela checkin existe.']);
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $errorMsg = $e->getMessage();
            // Não expor detalhes técnicos em produção, mas útil para debug
            echo json_encode(['error' => 'Erro no banco de dados. Verifique se a tabela checkin existe.']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao registrar check-in: ' . $e->getMessage()]);
        }
    }
}



