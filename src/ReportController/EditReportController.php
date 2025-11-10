<?php

namespace SceneReads\Mvc\ControllerBook;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Report;
use Systemfy\App\Repository\ReportRepository;

class EditReportController implements Controller
{
    function __construct(private ReportRepository $reportRepository)
    {
// editado aqui
    }
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $id_user = filter_input(INPUT_POST, 'id_user');
        if ($id_user === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $title = filter_input(INPUT_POST, 'title');
        if ($title === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $desc = filter_input(INPUT_POST, 'desc');
        if ($desc === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }


        $report = new Report($id_user, $title, $desc);
        $report->setId($id);

        $result = $this->reportRepository->update($report);

        if ($result === false) {
            header('Location: /booklist?sucesso=0');

        }else{
            header('Location: /booklist?sucesso=1');
        }

    }
}