<?php

namespace Systemfy\App\Admin\PlanoController;

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
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $categoria = filter_input(INPUT_POST, 'categoria');
        if ($categoria === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
        if ($preco === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $descricao = filter_input(INPUT_POST, 'descricao');
        if ($descricao === false) {
            header('Location: /admin/plano/list?sucesso=0');
            exit();
        }

        $ativoInput = filter_input(INPUT_POST, 'ativo');
        // Converter string '0' ou '1' para boolean
        $ativo = ($ativoInput === '1' || $ativoInput === 'true' || $ativoInput === true);

        $plano = new Plano($id, $categoria, $preco, $descricao, $ativo);

        $result = $this->planoRepository->update($plano);

        if ($result === false) {
            header('Location: /admin/plano/list?sucesso=0');// tela de plano

        }else{
            header('Location: /admin/plano/list?sucesso=1');
        }

    }
}