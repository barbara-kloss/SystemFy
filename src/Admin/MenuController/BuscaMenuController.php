<?php

namespace Systemfy\App\Admin\MenuController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\MenuRepository;

class BuscaMenuController implements Controller
{
    function __construct(private MenuRepository $menuRepository)
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
            $menuList = $this->menuRepository->findByUserId($id_user);
            
            $resultados = [];
            foreach ($menuList as $menu) {
                $resultados[] = [
                    'id' => $menu->getId(),
                    'horario' => $menu->horario,
                    'categoria' => $menu->categoria,
                    'titulo' => $menu->titulo,
                    'observacao' => $menu->observacao,
                    'id_user' => $menu->id_user
                ];
            }
            
            echo json_encode($resultados);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

