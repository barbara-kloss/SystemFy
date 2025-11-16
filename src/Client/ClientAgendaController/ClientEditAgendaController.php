<?php

namespace Systemfy\App\Client\ClientAgendaController;

use Systemfy\App\Controller\Controller;
use Systemfy\App\Model\Agenda;
use Systemfy\App\Repository\AgendaRepository;

class ClientEditAgendaController implements Controller
{
    function __construct(private AgendaRepository $agendaRepository)
    {
    }
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

         $data_reuniao = filter_input(INPUT_POST, 'data_reuniao');
        if ($data_reuniao === false) {
            header('Location: /client/agenda/list?sucesso=0');// decidir se insere ou busca
            exit();
        }

        $horario = filter_input(INPUT_POST, 'horario');
        if($horario === false){
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $assunto  = filter_input(INPUT_POST, 'assunto');
        if ($assunto === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $usuario_id  = filter_input(INPUT_POST, 'usuario_id');
        if ($usuario_id === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $personal_id = filter_input(INPUT_POST, 'personal_id', FILTER_VALIDATE_INT);
        if ($personal_id === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $nutri_id = filter_input(INPUT_POST, 'nutri_id', FILTER_VALIDATE_INT);
        if ($nutri_id === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false) {
            header('Location: /client/agenda/list?sucesso=0');
            exit();
        }

        $agenda = new Agenda($data_reuniao, $horario, $assunto, $usuario_id, $personal_id, $nutri_id, $titulo);
        $agenda->setId($id);

        $result = $this->agendaRepository->update($agenda);

        if ($result === false) {
            header('Location: /client/agenda/list?sucesso=0');// tela de report

        }else{
            header('Location: /client/agenda/list?sucesso=1');
        }

    }
}