<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\UserRepository;

class CriarSenhaController implements Controller
{
    function __construct(private UserRepository $userRepository) {}
    
    public function processaRequisicao(): void
    {
        $senha = filter_input(INPUT_POST, 'senha');
        $senha_confirmar = filter_input(INPUT_POST, 'senha_confirmar');
        $user_id = $_SESSION['user_id'] ?? null;
        
        // Validações
        if (!$user_id) {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Sessão expirada. Faça login novamente.'));
            exit();
        }
        
        if ($senha === false || $senha === null || $senha === '') {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Senha é obrigatória'));
            exit();
        }
        
        if (strlen($senha) < 6) {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Senha deve ter no mínimo 6 caracteres'));
            exit();
        }
        
        if ($senha_confirmar === false || $senha_confirmar === null || $senha_confirmar === '') {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Confirmação de senha é obrigatória'));
            exit();
        }
        
        if ($senha !== $senha_confirmar) {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('As senhas não coincidem'));
            exit();
        }
        
        try {
            $user = $this->userRepository->find($user_id);
            if ($user === null) {
                header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Usuário não encontrado'));
                exit();
            }
            
            // Atualizar senha
            $user->setSenha($senha);
            $result = $this->userRepository->update($user);
            
            if ($result) {
                header('Location: /criar-senha?sucesso=1');
            } else {
                header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Erro ao atualizar senha. Tente novamente.'));
            }
        } catch (\Exception $e) {
            header('Location: /criar-senha?sucesso=0&erro=' . urlencode('Erro: ' . $e->getMessage()));
        }
    }
}



