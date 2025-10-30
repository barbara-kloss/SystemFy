<?php

namespace Systemfy\App\Controller\ControllerUser;

use Systemfy\App\Controller\Controller;

class RegisterController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../View/cadastro.php';
    }
}