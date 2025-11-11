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
           /*
     * nome_completo,
     * data_nascimento,
     * genero,
     * telefone,
     * senha,
     * permissao,
     * altura,
     * peso,
     * objetivos,
     * status (bit),
     * observacao,
     * massa,
     * godura,
     * plano_id,
     * email*/
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
