<?php

namespace SceneReads\Mvc\ControllerLogin;

use SceneReads\Mvc\Controller\Controller;

class LoginFormController implements Controller
{

    public function processaRequisicao(): void
    {
        if(array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true) {
            header('location: /');
            return;
        }
        {
            require_once __DIR__ . '/../../login.php';
        }
    }
}