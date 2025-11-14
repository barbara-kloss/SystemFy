<?php

namespace Systemfy\App\Client\ClientAgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\AgendaRepository;

class ClientAgendaListController implements Controller
{

    function __construct(private AgendaRepository $agendaRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $agendaList = $this->agendaRepository->all();
        require_once __DIR__ . '/../../views/booklist.php';
    }


}