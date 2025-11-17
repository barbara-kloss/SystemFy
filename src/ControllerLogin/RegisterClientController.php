<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;

class RegisterClientController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../View/Cliente/telaPerfilCliente.php';
    }
}