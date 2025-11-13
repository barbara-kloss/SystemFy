<?php

namespace Systemfy\App\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Menu;
use Systemfy\App\Repository\MenuRepository;

class EditMenuController implements Controller
{
    function __construct(private MenuRepository $menuRepository)
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

        $horario = filter_input(INPUT_POST, 'horario');
        if ($horario === null || $horario === '') {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $objetivo = filter_input(INPUT_POST, 'objetivo');
        if ($objetivo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $restricao = filter_input(INPUT_POST, 'restricao');
        if ($restricao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $dia = filter_input(INPUT_POST, 'dia');
        if ($dia === null || $dia === '') {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $categoria = filter_input(INPUT_POST, 'categoria');
        if ($categoria === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $observacao = filter_input(INPUT_POST, 'observacao');
        if ($observacao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $id_user = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
        if ($id_user === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $id_nutri = filter_input(INPUT_GET, 'id_nutri', FILTER_VALIDATE_INT);
        if ($id_nutri === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }
        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $menu = new Menu($horario, $objetivo, $restricao, $dia, $categoria, $observacao, $id_user, $id_nutri, $titulo);
        $menu->setId($id);

        $result = $this->menuRepository->update($menu);

        if ($result === false) {
            header('Location: /booklist?sucesso=0');// tela de report

        }else{
            header('Location: /booklist?sucesso=1');
        }

    }
}