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
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $id_user = filter_input(INPUT_GET, 'id_user',FILTER_VALIDATE_INT);
        if ($id_user === false) {
            header('Location: /booklist?sucesso=0');// decidir se insere ou busca
            exit();
        }

        $peso = filter_input(INPUT_POST, 'peso',FILTER_VALIDATE_FLOAT);
        if($peso === false){
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $tempo_descanso = filter_input(INPUT_POST, 'tempo_descanso');
        if ($tempo_descanso === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $repeticao  = filter_input(INPUT_POST, 'repeticao',FILTER_VALIDATE_INT);
        if ($repeticao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $tipo_exercicio  = filter_input(INPUT_POST, 'tipo_exercicio');
        if ($tipo_exercicio === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $objetivo = filter_input(INPUT_POST, 'objetivo');
        if ($objetivo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $dia = filter_input(INPUT_POST, 'dia');
        if ($dia === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $observacao = filter_input(INPUT_POST, 'observacao');
        if ($observacao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $categoria = filter_input(INPUT_POST, 'categoria');
        if ($categoria === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }
        $id_personal = filter_input(INPUT_GET, 'id_personal',FILTER_VALIDATE_INT);
        if ($id_personal === false) {
            header('Location: /booklist?sucesso=0');// decidir se insere ou busca
            exit();
        }
        $video = filter_input(INPUT_POST, 'video', FILTER_VALIDATE_BOOLEAN);

        $exercise = new Exercise($id_user, $peso, $tempo_descanso, $repeticao, $tipo_exercicio, $objetivo, $dia, $observacao, $categoria, $id_personal, $video);
        $exercise->setId($id);

        $result = $this->exerciseRepository->update($exercise);

        if ($result === false) {
            header('Location: /booklist?sucesso=0');// tela de report

        }else{
            header('Location: /booklist?sucesso=1');
        }

    }
}