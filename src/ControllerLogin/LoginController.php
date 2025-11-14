<?php

namespace Systemfy\App\ControllerLogin;

use PDO;
use Systemfy\App\Controller\Controller;

class LoginController implements Controller
{
    private PDO $pdo;

    function __construct()
    {
        $caminho = __DIR__ . '/../../../databaselocal';
        $this->pdo = new PDO("mysql:$caminho");
    }

    public function processaRequisicao(): void
    {
        session_start();

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pwd   = filter_input(INPUT_POST, 'password');

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData || !password_verify($pwd, $userData['password'])) {
            header('Location: /login?sucesso=0');
            return;
        }

        // Salvar sessão
        $_SESSION['logado'] = true;
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['permissao'] = $userData['permissao']; // <-- aqui fica a permissão!

        // Redirecionar baseando no tipo
        if ($userData['permissao'] === 'admin') {
            header('Location: /admin');
            return;
        }

        if ($userData['permissao'] === 'cliente') {
            header('Location: /cliente');
            return;
        }

        // Por segurança
        header('Location: /');
    }
}
