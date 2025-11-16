<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;

class RegisterController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../View/Admin/telaNewCliente.html';
    }
}