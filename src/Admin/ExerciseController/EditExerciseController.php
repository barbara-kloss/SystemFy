<?php

namespace Systemfy\App\Admin\ExerciseController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Exercise;
use Systemfy\App\Repository\ExerciseRepository;

class EditExerciseController implements Controller
{
    function __construct(private ExerciseRepository $exerciseRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            header('Location: /admin/exercise/list?sucesso=0');
            exit();
        }

        // id_user é obrigatório (NOT NULL no banco e required no form)
        $id_user = filter_input(INPUT_POST, 'id_user', FILTER_VALIDATE_INT);
        if ($id_user === false || $id_user === null) {
            header('Location: /admin/exercise/list?sucesso=0');
            exit();
        }

        // peso é opcional no banco, mas no form pode ser 0
        $peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT);
        if ($peso === false) {
            $peso = null;
        }

        // repeticao é opcional no banco, mas required no form
        $repeticao = filter_input(INPUT_POST, 'repeticao');
        $repeticao = $repeticao !== null && trim($repeticao) !== '' ? trim($repeticao) : null;

        // tipo_exercicio é opcional no banco, mas required no form
        $tipo_exercicio = filter_input(INPUT_POST, 'tipo_exercicio');
        $tipo_exercicio = $tipo_exercicio !== null && trim($tipo_exercicio) !== '' ? trim($tipo_exercicio) : null;

        // dia é opcional no banco, mas required no form
        $dia = filter_input(INPUT_POST, 'dia', FILTER_VALIDATE_INT);
        if ($dia === false) {
            $dia = null;
        }

        // observacao é opcional
        $observacao = filter_input(INPUT_POST, 'observacao');
        $observacao = $observacao !== null && trim($observacao) !== '' ? trim($observacao) : null;

        // categoria é opcional no banco, mas required no form
        $categoria = filter_input(INPUT_POST, 'categoria');
        $categoria = $categoria !== null && trim($categoria) !== '' ? trim($categoria) : null;

        // id_personal vem da sessão (obrigatório na prática)
        $id_personal = $_SESSION['user_id'] ?? null;
        if ($id_personal === null) {
            header('Location: /admin/exercise/list?sucesso=0');
            exit();
        }

        // video é opcional
        $video = filter_input(INPUT_POST, 'video');
        $video = $video !== null && trim($video) !== '' ? trim($video) : null;

        $exercise = new Exercise(
            $id_user,
            $peso,
            $repeticao,
            $tipo_exercicio,
            $dia,
            $observacao,
            $categoria,
            $id_personal,
            $video,
            $id
        );

        $result = $this->exerciseRepository->update($exercise);

        if ($result === false) {
            header('Location: /admin/exercise/list?sucesso=0');
        } else {
            header('Location: /admin/exercise/list?sucesso=1');
        }
    }
}
