<?php

namespace Systemfy\App\ControllerLogin;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\UserRepository;
use Systemfy\App\Repository\PlanoRepository;

class GetClienteController implements Controller
{
    function __construct(
        private UserRepository $userRepository,
        private PlanoRepository $planoRepository
    ) {}

    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido']);
            return;
        }

        try {
            $user = $this->userRepository->find($id);
            
            if (!$user) {
                http_response_code(404);
                echo json_encode(['error' => 'Cliente não encontrado']);
                return;
            }

            // Retornar todos os dados do cliente
            $data = [
                'id' => $user->getId(),
                'nome_completo' => $user->getNome(),
                'email' => $user->getEmail(),
                'data_nascimento' => $user->getDataNasc()->getDate(),
                'genero' => $user->getGenero(),
                'telefone' => $user->getTelefone(),
                'altura' => $user->getAltura(),
                'peso' => $user->getPeso(),
                'objetivo' => $user->getObjetivo(),
                'observacao' => $user->getObservacao(),
                'massa' => $user->getMassa(),
                'gordura' => $user->getGordura(),
                'peso_meta' => $user->getPesoMeta(),
                'status' => $user->getStatus() ? 1 : 0,
                'plano_id' => $user->getPlanoId() ? $user->getPlanoId()->getId() : null
            ];

            echo json_encode($data);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}


