<?php

namespace Systemfy\App\Admin\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ReportRepository;

class ReportListController implements Controller
{

    function __construct(private ReportRepository $reportRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $reportList = $this->reportRepository->all();
        require_once __DIR__ . '/../../views/booklist.php';
    }


}