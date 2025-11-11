<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;

class LogoutController implements Controller
{

    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}