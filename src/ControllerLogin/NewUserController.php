<?php

namespace Systemfy\App\Controller\ControllerUser;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\User;
use Systemfy\App\Repository\UserRepository;

class NewUserController implements Controller
{

    function __construct(private UserRepository $userRepository) {}
    public function processaRequisicao(): void
    {
        $nome = filter_input(INPUT_POST, 'nome_completo');
        if ($nome === null || $nome === '') {
            header('Location: /?sucesso=0');
            exit();
        }
        $data_nasc = filter_input(INPUT_POST, 'data_nascimento');
        if ($data_nasc === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $genero = filter_input(INPUT_POST, 'genero');
        if ($genero === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $telefone = filter_input(INPUT_POST, 'telefone');
        if ($telefone === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $permissao = filter_input(INPUT_POST, 'permissao');
        if ($permissao === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $altura = filter_input(INPUT_POST, 'altura', FILTER_VALIDATE_FLOAT);
        if ($altura === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_INT);
        if ($peso === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $objetivos = filter_input(INPUT_POST, 'objetivos');
        if ($objetivos === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_BOOL);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if ($email === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $senha = filter_input(INPUT_POST, 'senha');
        if ($senha === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $observacao = filter_input(INPUT_POST, 'observacao');
        if ($observacao === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $massa = filter_input(INPUT_POST, 'massa', FILTER_VALIDATE_FLOAT);
        if ($massa === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $gordura = filter_input(INPUT_POST, 'gordura', FILTER_VALIDATE_FLOAT);
        if ($gordura === false) {
            header('Location: /?sucesso=0');
            exit();
        }
        $plano_id = filter_input(INPUT_GET, 'plano_id');
        if ($plano_id === false) {
            header('Location: /?sucesso=0');
            exit();
        }

        $result = $this->userRepository->add(new User($nome, $data_nasc, $genero, $telefone, $senha, $permissao, $altura, $peso, $objetivos, $status, $observacao, $massa, $gordura, $plano_id, $email,));
        if ($result === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
