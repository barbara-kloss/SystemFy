<?php

namespace Systemfy\App\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ReportRepository;

$caminho = __DIR__ . '/../../../databaselocal';
$pdo = new \PDO("mysql:$caminho");

class ReportFormController implements Controller
{

    function __construct(private ReportRepository $reportRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $report = null;
        if ($id !== false && $id !== null) {
            $report = $this->reportRepository->find($id);
        }
        require_once __DIR__ . '/../../views/formsbook.php';
    }
}