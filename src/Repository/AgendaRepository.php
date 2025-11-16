<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\config\Database;
use Systemfy\App\Model\Agenda;

class AgendaRepository
{
    private PDO $pdo;

    function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // ----------------------
    // CREATE
    // ----------------------
    public function add(Agenda $agenda): bool
    {
        $sql = "INSERT INTO agenda(
                    data_reuniao,
                    horario,
                    assunto,
                    id_user,
                    id_personal,
                    id_nutri,
                    titulo
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $agenda->data_reuniao);
        $stmt->bindValue(2, $agenda->horario);
        $stmt->bindValue(3, $agenda->assunto);
        $stmt->bindValue(4, $agenda->id_user);
        $stmt->bindValue(5, $agenda->id_personal);
        $stmt->bindValue(6, $agenda->id_nutri);
        $stmt->bindValue(7, $agenda->titulo);

        $result = $stmt->execute();

        if ($result) {
            $agenda->setId( (int)$this->pdo->lastInsertId() );
        }

        return $result;
    }

    // ----------------------
    // DELETE
    // ----------------------
    public function remove(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM agenda WHERE id = ?");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    // ----------------------
    // UPDATE
    // ----------------------
    public function update(Agenda $agenda): bool
    {
        $sql = "UPDATE agenda SET
                    data_reuniao = :data_reuniao,
                    horario = :horario,
                    assunto = :assunto,
                    id_user = :id_user,
                    id_personal = :id_personal,
                    id_nutri = :id_nutri,
                    titulo = :titulo
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':data_reuniao', $agenda->data_reuniao);
        $stmt->bindValue(':horario', $agenda->horario);
        $stmt->bindValue(':assunto', $agenda->assunto);
        $stmt->bindValue(':id_user', $agenda->id_user);
        $stmt->bindValue(':id_personal', $agenda->id_personal);
        $stmt->bindValue(':id_nutri', $agenda->id_nutri);
        $stmt->bindValue(':titulo', $agenda->titulo);
        $stmt->bindValue(':id', $agenda->id);

        return $stmt->execute();
    }

    // ----------------------
    // READ ALL
    // ----------------------
    public function all(): array
    {
        $data = $this->pdo
            ->query("SELECT * FROM agenda")
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map($this->hydrateAgenda(...), $data);
    }

    // ----------------------
    // READ ONE
    // ----------------------
    public function find(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM agenda WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydrateAgenda($stmt->fetch(PDO::FETCH_ASSOC));
    }

    // ----------------------
    // HYDRATE
    // ----------------------
    public function hydrateAgenda(array $data): Agenda
    {
        $agenda = new Agenda(
            $data['data_reuniao'],
            $data['horario'],
            $data['assunto'],
            $data['id_user'],
            $data['id_personal'],
            $data['id_nutri'],
            $data['titulo']
        );

        $agenda->setId($data['id']);

        return $agenda;
    }
}
