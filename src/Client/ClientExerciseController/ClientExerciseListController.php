<?php

namespace Systemfy\App\Client\ClientExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;

class ClientExerciseListController implements Controller
{

    function __construct(private ExerciseRepository $exerciseRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        if ($userId) {
            $exerciseList = $this->exerciseRepository->findByUserId((int) $userId);
        } else {
            $exerciseList = [];
        }
        
        require_once __DIR__ . '/../../../View/Cliente/telaTreinos.php';
    }


}