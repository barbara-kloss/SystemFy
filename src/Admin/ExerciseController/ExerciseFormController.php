<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Repository\ExerciseRepository;
use Systemfy\App\Database;
use PDO;


class ExerciseFormController implements Controller
{

    function __construct(private ExerciseRepository $exerciseRepository)
    {

    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $exercise = null;
        $nomeCliente = '';
        if ($id !== false && $id !== null) {
            $exercise = $this->exerciseRepository->find($id);
            if ($exercise && $exercise->id_user) {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare('SELECT nome_completo FROM user WHERE id = ?');
                $stmt->execute([$exercise->id_user]);
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                $nomeCliente = $userData['nome_completo'] ?? '';
            }
        }
        $exerciseList = [];
        require_once __DIR__ . '/../../../View/Admin/telaPersonal.php';
    }
}