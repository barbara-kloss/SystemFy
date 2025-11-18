<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Menu;
use Systemfy\App\Repository\MenuRepository;

class EditMenuController implements Controller
{
    function __construct(private MenuRepository $menuRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /admin/menu/list?sucesso=0');
            exit();
        }

        // horario é opcional no banco, mas required no form
        $horario = filter_input(INPUT_POST, 'horario');
        $horario = $horario !== null && trim($horario) !== '' ? trim($horario) : null;

        // categoria é opcional no banco, mas required no form
        $categoria = filter_input(INPUT_POST, 'categoria', FILTER_VALIDATE_INT);
        if ($categoria === false) {
            $categoria = null;
        }

        // observacao é opcional
        $observacao = filter_input(INPUT_POST, 'observacao');
        $observacao = $observacao !== null && trim($observacao) !== '' ? trim($observacao) : null;

        // id_user é opcional no banco, mas required no form
        $id_user = filter_input(INPUT_POST, 'id_user', FILTER_VALIDATE_INT);
        if ($id_user === false) {
            $id_user = null;
        }

        // id_nutri vem da sessão (obrigatório na prática)
        $id_nutri = $_SESSION['user_id'] ?? null;
        if ($id_nutri === null) {
            header('Location: /admin/menu/list?sucesso=0');
            exit();
        }

        // titulo é opcional no banco, mas required no form
        $titulo = filter_input(INPUT_POST, 'titulo');
        $titulo = $titulo !== null && trim($titulo) !== '' ? trim($titulo) : null;

        $menu = new Menu(
            $horario,
            $categoria,
            $observacao,
            $id_user,
            $id_nutri,
            $titulo,
            $id
        );

        $result = $this->menuRepository->update($menu);

        if ($result === false) {
            header('Location: /admin/menu/list?sucesso=0');
        } else {
            header('Location: /admin/menu/list?sucesso=1');
        }
    }
}
