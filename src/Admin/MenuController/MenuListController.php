<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;

class MenuListController implements Controller
{

    function __construct(private MenuRepository $menuRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $menuList = $this->menuRepository->all();
        $menu = null;
        require_once __DIR__ . '/../../../View/Admin/telaNutricionalAdmin.php';
    }


}