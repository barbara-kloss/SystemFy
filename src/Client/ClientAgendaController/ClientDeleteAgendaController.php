<?php

namespace Systemfy\App\Client\ClientAgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\AgendaRepository;

class ClientDeleteAgendaController implements Controller
{
    function __construct(private readonly AgendaRepository $agendaRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /client/agenda/list?sucesso=0'); // pagina de registro de report
            exit();
        }

        $result = $this->agendaRepository->remove($id);
        if ($result === false) {
            header('Location: /client/agenda/list?sucesso=0');

        }else{
            header('Location: /client/agenda/list?sucesso=1' );
        }
    }
}