<?php

namespace Systemfy\App\PlanoController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\PlanoRepository;

class DeletePlanoController implements Controller
{
    function __construct(private readonly PlanoRepository $planoRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /booklist?sucesso=0'); // pagina de registro de report
            exit();
        }

        $result = $this->planoRepository->remove($id);
        if ($result === false) {
            header('Location: /booklist?sucesso=0');

        }else{
            header('Location: /booklist?sucesso=1' );
        }
    }
}