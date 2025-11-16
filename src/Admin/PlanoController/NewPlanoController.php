<?php

namespace Systemfy\App\Admin\PlanoController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Plano;
use Systemfy\App\Repository\PlanoRepository;

class NewPlanoController implements Controller
{
    function __construct(private PlanoRepository $planoRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $categoria = filter_input(INPUT_POST, 'categoria');
        if ($categoria === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT);
        if ($preco === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $descricao = filter_input(INPUT_POST, 'descricao');
        if ($descricao === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $ativo = filter_input(INPUT_POST, 'ativo', FILTER_VALIDATE_BOOL);
// categoria, preco, descricao
        $result = $this->planoRepository->add(new Plano($categoria, $preco, $descricao, $ativo));

        if ($result === false){
            header('Location: /admin/plano/list?sucesso=0');
        }else{
            header('Location: /admin/plano/list?sucesso=1');
        }
    }
}