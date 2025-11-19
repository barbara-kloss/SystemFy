<?php

namespace Systemfy\App\Controller;

use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Model\User;
use Systemfy\App\Model\Date;

class EditPerfilAdminController implements Controller
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
            header('Location: /admin/perfil?erro=' . urlencode('Usuário não encontrado'));
            exit();
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING) ?? $user->getNome();
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? $user->getEmail();
        $foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_STRING) ?? $user->getFoto();

        $senha = filter_input(INPUT_POST, 'senha');
        $senhaFinal = $user->getSenha();
        if (!empty($senha)) {
            $senhaInfo = @password_get_info($senha);
            if (!isset($senhaInfo['algo']) || $senhaInfo['algo'] === false || $senhaInfo['algo'] === null) {
                $senhaFinal = password_hash($senha, PASSWORD_ARGON2ID);
            } else {
                $senhaFinal = $senha;
            }
        }

        $userAtualizado = new User(
            $user->getId(),
            $nome,
            $user->getDataNasc(),
            $user->getGenero(),
            $user->getTelefone(),
            $senhaFinal,
            $user->getPermissao(),
            $user->getAltura(),
            $user->getPeso(),
            $user->getObjetivo(),
            $user->getStatus(),
            $user->getObservacao(),
            $user->getMassa(),
            $user->getGordura(),
            $user->getPlanoId(),
            $email,
            $foto,
            $user->getPesoMeta()
        );

        try {
            $result = $this->userRepository->update($userAtualizado);
            
            if ($result) {
                header('Location: /admin/perfil?sucesso=1');
            } else {
                $errorInfo = $this->userRepository->getLastError();
                header('Location: /admin/perfil?erro=' . urlencode($errorInfo ?? 'Erro ao atualizar perfil'));
            }
        } catch (\Exception $e) {
            header('Location: /admin/perfil?erro=' . urlencode('Erro ao atualizar: ' . $e->getMessage()));
        }
    }
}

