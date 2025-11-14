<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;

class DeleteMenuController implements Controller
{
    function __construct(private readonly MenuRepository $menuRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /booklist?sucesso=0'); // pagina de registro de report
            exit();
        }

        $result = $this->menuRepository->remove($id);
        if ($result === false) {
            header('Location: /booklist?sucesso=0');

        }else{
            header('Location: /booklist?sucesso=1' );
        }
    }
}