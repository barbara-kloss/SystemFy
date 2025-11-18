<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;

class BuscaExerciseController implements Controller
{
    function __construct(private ExerciseRepository $exerciseRepository)
    {
    }

    public function processaRequisicao(): void
    {
        header('Content-Type: application/json');
        
        $id_user = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
        
        if (!$id_user) {
            echo json_encode([]);
            return;
        }

        try {
            $exerciseList = $this->exerciseRepository->findByUserId($id_user);
            
            $resultados = [];
            foreach ($exerciseList as $exercise) {
                $resultados[] = [
                    'id' => $exercise->getId(),
                    'tipo_exercicio' => $exercise->tipo_exercicio,
                    'categoria' => $exercise->categoria,
                    'dia' => $exercise->dia,
                    'repeticao' => $exercise->repeticao,
                    'peso' => $exercise->peso,
                    'observacao' => $exercise->observacao,
                    'video' => $exercise->video,
                    'id_user' => $exercise->id_user
                ];
            }
            
            echo json_encode($resultados);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

