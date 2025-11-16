<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;

class MenuFormController implements Controller
{

    function __construct(private MenuRepository $menuRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $menu = null;
        if ($id !== false && $id !== null) {
            $menu = $this->menuRepository->find($id);
        }
        require_once __DIR__ . '/../../View/Admin/telaNutricionalAdmin.html';
    }
}