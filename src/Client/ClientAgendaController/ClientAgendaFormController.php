<?php

namespace Systemfy\App\Client\ClientAgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\AgendaRepository;

$caminho = __DIR__ . '/../../../databaselocal';
$pdo = new \PDO("mysql:$caminho");

class ClientAgendaFormController implements Controller
{

    function __construct(private AgendaRepository $agendaRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $agenda = null;
        if ($id !== false && $id !== null) {
            $agenda = $this->agendaRepository->find($id);
        }
        require_once __DIR__ . '/../../views/formsbook.php';
    }
}