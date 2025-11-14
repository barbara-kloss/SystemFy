<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;

class DeleteExerciseController implements Controller
{
    function __construct(private readonly ExerciseRepository $exerciseRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /booklist?sucesso=0'); // pagina de registro de report
            exit();
        }

        $result = $this->exerciseRepository->remove($id);
        if ($result === false) {
            header('Location: /booklist?sucesso=0');

        }else{
            header('Location: /booklist?sucesso=1' );
        }
    }
}