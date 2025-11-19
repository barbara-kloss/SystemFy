<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Repository\PlanoRepository;

class PerfilClienteController implements Controller
{
    function __construct(
        private UserRepository $userRepository,
        private PlanoRepository $planoRepository
    ) {}

    public function processaRequisicao(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        
        if (!$userId) {
            header('Location: /login');
            exit();
        }

        $user = $this->userRepository->find((int) $userId);
        
        if (!$user) {
            header('Location: /client');
            exit();
        }

        require_once __DIR__ . '/../../View/Cliente/telaPerfilCliente.php';
    }
}

