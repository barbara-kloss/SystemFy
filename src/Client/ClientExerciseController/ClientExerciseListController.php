<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;

class ClientExerciseListController implements Controller
{

    function __construct(private ExerciseRepository $exerciseRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $exerciseList = $this->exerciseRepository->all();
        require_once __DIR__ . '/../../views/booklist.php';
    }


}