<?php

namespace Systemfy\App\Admin\PlanoController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\PlanoRepository;

$caminho = __DIR__ . '/../../../databaselocal';
$pdo = new \PDO("mysql:$caminho");

class PlanoFormController implements Controller
{

    function __construct(private PlanoRepository $planoRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $plano = null;
        if ($id !== false && $id !== null) {
            $plano = $this->planoRepository->find($id);
        }
        require_once __DIR__ . '/../../views/formsbook.php';
    }
}