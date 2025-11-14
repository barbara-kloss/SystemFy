<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\config\database;
use Systemfy\App\Model\Agenda;
class AgendaRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = database::getConnection();
    }

    public function add(Agenda $agenda) : bool
    {
        $sql = "INSERT INTO agenda(horario, 
        objetivo, restricao, 
        dia, categoria, 
        observacao, id_user, id_nutri) values(?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $agenda->horario);
        $stmt->bindValue(2, $agenda->objetivo);
        $stmt->bindValue(3, $agenda->restricao);
        $stmt->bindValue(4, $agenda->dia);
        $stmt->bindValue(5, $agenda->categoria);
        $stmt->bindValue(6, $agenda->observacao);
        $stmt->bindValue(7, $agenda->id_user);
        $stmt->bindValue(8, $agenda->id_nutri);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $agenda->setId(intval($id));
        return $result;
    }
    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM agenda WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function update(Agenda $agenda): bool
    {
        $sql = 'UPDATE agenda SET data_reuniao = :data_reuniao, 
        horario= :horario, duracao= :duracao,
        assunto = :assunto, id_user = :id_user, 
        id_personal = :id_personal, 
        id_nutri = :id_nutri  WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':data_reuniao', $agenda->data_reuniao);
        $stmt->bindValue(':horario', $agenda->horario);
        $stmt->bindValue(':duracao', $agenda->duracao);
        $stmt->bindValue(':assunto', $agenda->assunto);
        $stmt->bindValue(':id_user', $agenda->id_user);
        $stmt->bindValue(':id_personal', $agenda->id_personal);
        $stmt->bindValue(':id_nutri', $agenda->id_nutri);
        $stmt->bindValue(':id', $agenda->id);

        return $stmt->execute();
    }

    public function all(): array
    {
        $agendaList = $this->pdo
            ->query('SELECT * FROM agenda;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateAgenda(...),
            $agendaList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM agenda WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateAgenda($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateAgenda(array $AgendaData): Agenda
    {
        $agenda = new Agenda($AgendaData['data_reuniao'],
            $AgendaData['horario'],
            $AgendaData['duracao'],
            $AgendaData['assunto'],
            $AgendaData['id_user'],
            $AgendaData['id_personal'],
            $AgendaData['id_nutri']);
        $agenda->setId($AgendaData['id']);
        return $agenda;
    }


}

