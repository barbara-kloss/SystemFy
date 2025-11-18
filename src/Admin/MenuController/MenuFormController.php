<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;
use Systemfy\App\Database;
use PDO;

class MenuFormController implements Controller
{

    function __construct(private MenuRepository $menuRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $menu = null;
        $nomeCliente = '';
        if ($id !== false && $id !== null) {
            $menu = $this->menuRepository->find($id);
            if ($menu && $menu->id_user) {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare('SELECT nome_completo FROM user WHERE id = ?');
                $stmt->execute([$menu->id_user]);
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                $nomeCliente = $userData['nome_completo'] ?? '';
            }
        }
        $menuList = $this->menuRepository->all();
        require_once __DIR__ . '/../../../View/Admin/telaNutricionalAdmin.php';
    }
}