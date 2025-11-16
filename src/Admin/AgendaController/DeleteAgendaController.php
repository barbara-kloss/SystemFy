<?php

namespace Systemfy\App\Admin\AgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\AgendaRepository;

class DeleteAgendaController implements Controller
{
    function __construct(private readonly AgendaRepository $agendaRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /admin/agenda/list?sucesso=0'); // pagina de registro de report
            exit();
        }

        $result = $this->agendaRepository->remove($id);
        if ($result === false) {
            header('Location: /admin/agenda/list?sucesso=0');

        }else{
            header('Location: /admin/agenda/list?sucesso=1' );
        }
    }
}