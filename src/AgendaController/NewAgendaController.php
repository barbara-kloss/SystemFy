<?php

namespace Systemfy\App\AgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Agenda;
use Systemfy\App\Repository\AgendaRepository;

class NewAgendaController implements Controller
{
    function __construct(private AgendaRepository $agendaRepository)
    {
       
    }

    public function processaRequisicao(): void
    {
        $data_reuniao = filter_input(INPUT_POST, 'data_reuniao');
        if ($data_reuniao === false) {
            header('Location: /booklist?sucesso=0');// decidir se insere ou busca
            exit();
        }

        $horario = filter_input(INPUT_POST, 'horario');
        if($horario === false){
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $duracao = filter_input(INPUT_POST, 'duracao');
        if ($duracao === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $assunto  = filter_input(INPUT_POST, 'assunto');
        if ($assunto === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $usuario_id  = filter_input(INPUT_POST, 'usuario_id');
        if ($usuario_id === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $personal_id = filter_input(INPUT_POST, 'personal_id', FILTER_VALIDATE_INT);
        if ($personal_id === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $nutri_id = filter_input(INPUT_POST, 'nutri_id', FILTER_VALIDATE_INT);
        if ($nutri_id === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /booklist?sucesso=0');
            exit();
        }

        $result = $this->agendaRepository->add(new Agenda($data_reuniao, $horario, $duracao, $assunto, $usuario_id, $personal_id, $nutri_id, $titulo));

        if ($result === false){
            header('Location: /booklist?sucesso=0');
        }else{
            header('Location: /booklist?sucesso=1');
        }
    }
}