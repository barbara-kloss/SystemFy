<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Model\Exercise;
use Systemfy\App\Database;

class ExerciseRepository
{
    private PDO $pdo;
    
    function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function add(Exercise $exercise): bool
    {
        $sql = "INSERT INTO exercise(id_user, peso, repeticao, tipo_exercicio, dia, observacao, categoria, id_personal, video) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $exercise->id_user, PDO::PARAM_INT);
        $stmt->bindValue(2, $exercise->peso, $exercise->peso !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(3, $exercise->repeticao, $exercise->repeticao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(4, $exercise->tipo_exercicio, $exercise->tipo_exercicio !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(5, $exercise->dia, $exercise->dia !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(6, $exercise->observacao, $exercise->observacao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(7, $exercise->categoria, $exercise->categoria !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(8, $exercise->id_personal, $exercise->id_personal !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(9, $exercise->video, $exercise->video !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);

        $result = $stmt->execute();
        if ($result) {
            $id = $this->pdo->lastInsertId();
            $exercise->setId(intval($id));
        }
        return $result;
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM exercise WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(Exercise $exercise): bool
    {
        $sql = 'UPDATE exercise SET 
                id_user = :id_user,
                peso = :peso, 
                repeticao = :repeticao,
                tipo_exercicio = :tipo_exercicio, 
                dia = :dia, 
                observacao = :observacao, 
                categoria = :categoria, 
                id_personal = :id_personal,
                video = :video 
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_user', $exercise->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':peso', $exercise->peso, $exercise->peso !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':repeticao', $exercise->repeticao, $exercise->repeticao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':tipo_exercicio', $exercise->tipo_exercicio, $exercise->tipo_exercicio !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':dia', $exercise->dia, $exercise->dia !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':observacao', $exercise->observacao, $exercise->observacao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':categoria', $exercise->categoria, $exercise->categoria !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':id_personal', $exercise->id_personal, $exercise->id_personal !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':video', $exercise->video, $exercise->video !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':id', $exercise->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function all(): array
    {
        $exerciseList = $this->pdo
            ->query('SELECT * FROM exercise ORDER BY id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateExercise(...),
            $exerciseList
        );
    }

    public function find(int $id): ?Exercise
    {
        $stmt = $this->pdo->prepare('SELECT * FROM exercise WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->hydrateExercise($data);
    }

    public function findByUserId(int $id_user): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM exercise WHERE id_user = ? ORDER BY id DESC');
        $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $exerciseList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateExercise(...),
            $exerciseList
        );
    }

    public function hydrateExercise(array $exerciseData): Exercise
    {
        $exercise = new Exercise(
            (int) $exerciseData['id_user'],
            isset($exerciseData['peso']) && $exerciseData['peso'] !== null ? (float) $exerciseData['peso'] : null,
            $exerciseData['repeticao'] ?? null,
            $exerciseData['tipo_exercicio'] ?? null,
            isset($exerciseData['dia']) && $exerciseData['dia'] !== null ? (int) $exerciseData['dia'] : null,
            $exerciseData['observacao'] ?? null,
            $exerciseData['categoria'] ?? null,
            isset($exerciseData['id_personal']) && $exerciseData['id_personal'] !== null ? (int) $exerciseData['id_personal'] : null,
            $exerciseData['video'] ?? null,
            isset($exerciseData['id']) ? (int) $exerciseData['id'] : null
        );
        return $exercise;
    }
}
