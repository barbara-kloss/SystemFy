<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;

class PerfilAdminController implements Controller
{
    function __construct(
        private UserRepository $userRepository
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
            header('Location: /admin');
            exit();
        }

        require_once __DIR__ . '/../../View/Admin/telaPerfilAdmin.php';
    }
}

