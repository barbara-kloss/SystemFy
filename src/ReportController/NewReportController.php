<?php

namespace Systemfy\App\ReportController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Report;
use Systemfy\App\Repository\ReportRepository;

class NewReportController implements Controller
{
    function __construct(private ReportRepository $reportRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id_user = filter_input(INPUT_GET, 'id_user',FILTER_VALIDATE_INT);
        if ($id_user === false) {
            header('Location: /booklist?sucesso=0');// decidir se insere ou busca
            exit();
        }

        $id_personal  = filter_input(INPUT_GET, 'id_personal',FILTER_VALIDATE_INT);
        if ($id_personal === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $id_nutri  = filter_input(INPUT_GET, 'id_personal',FILTER_VALIDATE_INT);
        if ($id_nutri === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $anotacao = filter_input(INPUT_POST, 'anotacao');
        if ($anotacao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $dia = filter_input(INPUT_POST, 'dia');
        if ($dia === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $exe_feito = filter_input(INPUT_GET, 'exe_feito', FILTER_VALIDATE_BOOLEAN);
        $menu_feito = filter_input(INPUT_GET, 'menu_feito', FILTER_VALIDATE_BOOLEAN);

        $objetivo = filter_input(INPUT_POST, 'objetivo');
        if ($objetivo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $plano = filter_input(INPUT_GET, 'plano');
        if ($plano === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }
        $result = $this->reportRepository->add(new Report($id_user, $id_personal, $id_nutri, $anotacao, $dia, $exe_feito, $menu_feito, $objetivo, $plano, $titulo));

        if ($result === false){
            header('Location: /booklist?sucesso=0');
        }else{
            header('Location: /booklist?sucesso=1');
        }
    }
}