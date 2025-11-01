<?php

namespace Systemfy\App\Controller\ControllerUser;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\User;
// use Systemfy\App\Service\UserRepository;

class NewUserController implements Controller
{
    
        //functtion __construct(private UserRepository $userRepository) {}
        public function processaRequisicao(): void
        {
            /*string $nome;
Date $data_nasc;
string $genero;
string $telefone;
string $permissao;
float $altura;
int $peso;
FILTER_VALIDATE_INT
bool $status;
string $observacao;
float $massa;
float $gordura;
Plano $plano_id;
string $objetivo;*/ 
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if ($email === false){
            header('Location: /?sucesso=0');
            exit();
        }

        $senha = filter_input(INPUT_POST, 'senha');
        if ($senha === false){
            header('Location: /?sucesso=0');
            exit();
        }

        //$result = $this->userRepository->add(new User($email, $senha));
        // if ($result === false){
        //     header('Location: /?sucesso=0');
        // }else{
        //     header('Location: /?sucesso=1');
        // }
        }
    }
