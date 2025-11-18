<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;

class MainClienteController implements Controller
{
    function __construct(private UserRepository $userRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $userId = $_SESSION['user_id'] ?? null;
        $user = null;
        
        if ($userId) {
            $user = $this->userRepository->find((int) $userId);
        }
        
        require_once __DIR__ . '/../../View/Cliente/telaInicial.php';
    }
}