<?php

namespace SceneReads\Mvc\ControllerLogin;

use SceneReads\Mvc\Controller\Controller;
use PDO;

class LoginController implements Controller
{
    private PDO $pdo;

    function __construct()
    {
        $caminho = __DIR__ . '/../../banco-mylist';
        $pdo = new PDO("sqlite:$caminho");
        $this->pdo = new PDO("sqlite:$caminho");
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pwd = filter_input(INPUT_POST, 'password');

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $correctPassword = password_verify($pwd, $userData['password']);

        if ($correctPassword) {
            $_SESSION['logado'] = true;
            header('location: /');
        }else{
            header('location: /login?sucesso=0');
        }
    }
}