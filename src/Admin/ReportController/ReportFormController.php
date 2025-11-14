<?php

namespace Systemfy\App\Admin\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ReportRepository;

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