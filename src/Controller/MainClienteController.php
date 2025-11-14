<?php

namespace Systemfy\App\Controller;

class MainClienteController implements Controller
{
    public function processaRequisicao(): void
    {
        require_once __DIR__ . '/../../View/LoginGeralHTML.html';
    }
}