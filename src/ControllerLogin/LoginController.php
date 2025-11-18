<?php

namespace Systemfy\App\ControllerLogin;

use PDO;
use Systemfy\App\Controller\Controller;
use Systemfy\App\Database;

class LoginController implements Controller
{
    private PDO $pdo;

    function __construct()
    {
        $this->pdo = database::getConnection();
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pwd   = filter_input(INPUT_POST, 'senha');

        // Validações
        if ($email === false || $email === null) {
            header('Location: /login?sucesso=0&erro=' . urlencode('Email inválido'));
            exit();
        }

        if ($pwd === false || $pwd === null || $pwd === '') {
            header('Location: /login?sucesso=0&erro=' . urlencode('Senha é obrigatória'));
            exit();
        }

        try {
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt === false) {
                header('Location: /login?sucesso=0&erro=' . urlencode('Erro ao conectar com o banco de dados'));
                exit();
            }
            
            $stmt->bindValue(1, $email);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                header('Location: /login?sucesso=0&erro=' . urlencode('Email não encontrado'));
                exit();
            }

            // Limpar espaços em branco da senha
            $pwd = trim($pwd);
            $senhaBanco = trim($userData['senha']);
            
            // Verificar se a senha está em hash
            $senhaInfo = @password_get_info($senhaBanco);
            $isHashed = isset($senhaInfo['algo']) && $senhaInfo['algo'] !== false && $senhaInfo['algo'] !== null;
            
            $senhaValida = false;
            $debugInfo = [];
            
            if ($isHashed) {
                // Senha está em hash, usar password_verify
                $senhaValida = password_verify($pwd, $senhaBanco);
                $debugInfo[] = 'Hash verificado';
            } else {
                // Senha antiga não hasheada, comparar diretamente (case-sensitive)
                $senhaValida = ($pwd === $senhaBanco);
                $debugInfo[] = 'Comparação direta';
                
                // Se a senha estiver correta mas não estiver em hash, atualizar para hash
                if ($senhaValida) {
                    try {
                        $newHash = password_hash($pwd, PASSWORD_ARGON2ID);
                        $updateStmt = $this->pdo->prepare("UPDATE user SET senha = ? WHERE id = ?");
                        $updateStmt->bindValue(1, $newHash);
                        $updateStmt->bindValue(2, $userData['id'], PDO::PARAM_INT);
                        $updateStmt->execute();
                        $debugInfo[] = 'Senha atualizada para hash';
                    } catch (\Exception $e) {
                        // Continuar mesmo se não conseguir atualizar
                        $debugInfo[] = 'Erro ao atualizar hash: ' . $e->getMessage();
                    }
                }
            }

            if (!$senhaValida) {
                // Debug temporário - remover em produção
                $erroMsg = 'Senha incorreta';
                if (isset($_GET['debug'])) {
                    $erroMsg .= ' | Debug: ' . implode(', ', $debugInfo);
                    $erroMsg .= ' | Senha banco length: ' . strlen($senhaBanco);
                    $erroMsg .= ' | Senha input length: ' . strlen($pwd);
                    $erroMsg .= ' | Is hashed: ' . ($isHashed ? 'sim' : 'não');
                }
                header('Location: /login?sucesso=0&erro=' . urlencode($erroMsg) . '&email=' . urlencode($email));
                exit();
            }

            // Verificar se o usuário está ativo
            if (isset($userData['status']) && $userData['status'] == 0) {
                header('Location: /login?sucesso=0&erro=' . urlencode('Usuário inativo. Entre em contato com o administrador'));
                exit();
            }

            // Salvar sessão
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['permissao'] = $userData['permissao'];
            $_SESSION['user_email'] = $userData['email'];

            // Redirecionar baseando no tipo
            if ($userData['permissao'] === 'admin') {
                header('Location: /admin');
                exit();
            }

            if ($userData['permissao'] === 'cliente') {
                header('Location: /client');
                exit();
            }

            // Por segurança
            header('Location: /');
            exit();
        } catch (\PDOException $e) {
            header('Location: /login?sucesso=0&erro=' . urlencode('Erro ao processar login. Tente novamente.'));
            exit();
        }
    }
}
