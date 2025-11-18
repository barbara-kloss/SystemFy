<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;

class CriarSenhaFormController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../View/telaCriarSenha.php';
    }
}


