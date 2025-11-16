<?php

namespace Systemfy\App\Admin\PlanoController;
use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\PlanoRepository;

class PlanoListController implements Controller
{

    function __construct(private PlanoRepository $planoRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $planoList = $this->planoRepository->all();
        require_once __DIR__ . '/../../View/Admin/telaPlanos.html';
    }

}