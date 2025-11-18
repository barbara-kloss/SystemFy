<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\PlanoRepository;

class RegisterController implements Controller
{
    function __construct(private PlanoRepository $planoRepository) {}
    
    public function processaRequisicao(): void
    {
        $planos = $this->planoRepository->all();
        require_once __DIR__ . '/../../View/Admin/telaNewCliente.php';
    }
}