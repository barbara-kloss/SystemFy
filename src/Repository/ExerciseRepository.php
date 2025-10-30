<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Model\Exercise;    
class ExerciseRepository
{
    function __construct(private PDO $pdo)
    {
    }

    public function add(Exercise $exercise) : bool
    {
        $sql = "INSERT INTO ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $exercise->);
        $stmt->bindValue(2, $exercise->getId());
        $stmt->bindValue(3, $exercise->getName());
    }
}

?>