<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Repository\CheckinRepository;

class MainAdminController implements Controller
{
    function __construct(
        private UserRepository $userRepository,
        private CheckinRepository $checkinRepository
    ) {}

    public function processaRequisicao(): void
    {
        // Buscar contagem de clientes ativos
        $clientesAtivos = $this->userRepository->countActiveClients();
        
        // Buscar check-ins recentes para notificações
        $checkins = $this->checkinRepository->findRecent(10);
        
        require_once __DIR__ . '/../../View/Admin/telaInicialAdmin.php';
    }
}
?>