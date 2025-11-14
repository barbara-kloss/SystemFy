<?php

namespace Systemfy\App\Admin\MenuController;

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
        require_once __DIR__ . '/../../views/booklist.php';
    }


}