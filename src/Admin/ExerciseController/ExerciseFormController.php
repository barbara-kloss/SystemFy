<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;


class ExerciseFormController implements Controller
{

    function __construct(private ExerciseRepository $exerciseRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $exercise = null;
        if ($id !== false && $id !== null) {
            $exercise = $this->exerciseRepository->find($id);
        }
        require_once __DIR__ . '/../../View/Admin/telaPersonal.html';
    }
}