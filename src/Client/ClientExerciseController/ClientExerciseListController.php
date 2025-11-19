<?php

namespace Systemfy\App\Client\ClientExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;
use Systemfy\App\Repository\CheckinRepository;

class ClientExerciseListController implements Controller
{

    function __construct(
        private ExerciseRepository $exerciseRepository,
        private CheckinRepository $checkinRepository
    ) {

    }

    public function processaRequisicao(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            $exerciseList = $this->exerciseRepository->findByUserId((int) $userId);
            // Buscar check-ins de hoje do usuário
            $checkinsHoje = $this->checkinRepository->findTodayByUser((int) $userId);
        } else {
            $exerciseList = [];
            $checkinsHoje = [];
        }
        
        // Debug temporário - remover depois
        // error_log("Check-ins hoje para usuário $userId: " . json_encode($checkinsHoje));
        
        require_once __DIR__ . '/../../../View/Cliente/telaTreinos.php';
    }


}