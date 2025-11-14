<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Model\Exercise;
use Systemfy\App\config\database;
class ExerciseRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = database::getConnection();
    }

    public function add(Exercise $exercise) : bool
    {
        $sql = "INSERT INTO exercise(id_user, peso, tempo_descanso, repeticao, tipo_exercicio, objetivo, dia, observacao, categoria, id_personal, video) values(?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $exercise->id_user);
        $stmt->bindValue(2, $exercise->peso);
        $stmt->bindValue(3, $exercise->tempo_descanso);
        $stmt->bindValue(4, $exercise->repeticao);
        $stmt->bindValue(5, $exercise->tipo_exercicio);
        $stmt->bindValue(6, $exercise->objetivo);
        $stmt->bindValue(7, $exercise->dia);
        $stmt->bindValue(8, $exercise->observacao);
        $stmt->bindValue(9, $exercise->categoria);
        $stmt->bindValue(10, $exercise->id_personal);
        $stmt->bindValue(11, $exercise->video);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $exercise->setId(intval($id));
        return $result;
    }
    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM exercise WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function update(Exercise $exercise): bool
    {
        $sql = 'UPDATE exercise SET peso = :peso, 
        tempo_descanso= :tempo_descanso, repeticao= :repeticao,
        tipo_exercicio = :tipo_exercicio, objetivo = :objetivo, 
        dia = :dia, observacao = :observacao, categoria = :categoria, video = :video  WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':peso', $exercise->peso);
        $stmt->bindValue(':tempo_descanso', $exercise->tempo_descanso);
        $stmt->bindValue(':repeticao', $exercise->repeticao);
        $stmt->bindValue(':tipo_exercicio', $exercise->tipo_exercicio);
        $stmt->bindValue(':objetivo', $exercise->objetivo);
        $stmt->bindValue(':dia', $exercise->dia);
        $stmt->bindValue(':observacao', $exercise->observacao);
        $stmt->bindValue(':categoria', $exercise->categoria);
        $stmt->bindValue(':video', $exercise->video);
        $stmt->bindValue(':id', $exercise->id);

        return $stmt->execute();
    }

    public function all(): array
    {
        $exerciseList = $this->pdo
            ->query('SELECT * FROM exercise;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateExercise(...),
            $exerciseList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM exercise WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateExercise($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateExercise(array $ExerciseData): Exercise
    {
        $exercise = new Exercise( $ExerciseData['id_user'],
            $ExerciseData['peso'],
            $ExerciseData['tempo_descanso'],
            $ExerciseData['repeticao'],
            $ExerciseData['tipo_exercicio'],
            $ExerciseData['objetivo'],
            $ExerciseData['dia'],
            $ExerciseData['observacao'],
            $ExerciseData['categoria'],
            $ExerciseData['id_personal'],
         $ExerciseData['video']);
        $exercise->setId($ExerciseData['id']);
        return $exercise;
    }


}

