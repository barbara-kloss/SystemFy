<?php

namespace Systemfy\App\PlanoController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Plano;
use Systemfy\App\Repository\PlanoRepository;

class EditPlanoController implements Controller
{
    function __construct(private PlanoRepository $planoRepository)
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

        $categoria = filter_input(INPUT_POST, 'categoria');
        if ($categoria === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
        if ($preco === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $descricao = filter_input(INPUT_POST, 'descricao');
        if ($descricao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }


        $plano = new Plano($categoria, $preco, $descricao);
        $plano->setId($id);

        $result = $this->planoRepository->update($plano);

        if ($result === false) {
            header('Location: /booklist?sucesso=0');// tela de plano

        }else{
            header('Location: /booklist?sucesso=1');
        }

    }
}