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

        $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
        if ($preco === false || $preco === null) {
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
        
        // Criar plano com id temporário (será definido pelo repository após inserção)
        $plano = new Plano(0, $categoria, $preco, $descricao, $ativo);
        $result = $this->planoRepository->add($plano);

        if ($result === false){
            header('Location: /admin/plano/list?sucesso=0');
        }else{
            header('Location: /admin/plano/list?sucesso=1');
        }
    }
}