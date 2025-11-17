<?php

namespace Systemfy\App\Client\ClientMenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;

class ClientMenuListController implements Controller
{

    function __construct(private MenuRepository $menuRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $menuList = $this->menuRepository->all();
        require_once __DIR__ . '/../../../View/Cliente/telaNutricional.php';
    }


}