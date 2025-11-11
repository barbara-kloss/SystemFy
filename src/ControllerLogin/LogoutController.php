<?php

namespace SceneReads\Mvc\ControllerLogin;

use SceneReads\Mvc\Controller\Controller;

class LogoutController implements Controller
{

    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}