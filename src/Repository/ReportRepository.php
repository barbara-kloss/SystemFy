<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Database;
use Systemfy\App\Model\Report;
class ReportRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function add(Report $report) : bool
    {
        $sql = "INSERT INTO report(id_user, id_personal, id_nutri, dia, 
        objetivo, plano) values(?,?,?,?,?,?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $report->id_user);
        $stmt->bindValue(2, $report->id_personal);
        $stmt->bindValue(3, $report->id_nutri);
        $stmt->bindValue(4, $report->dia);
        $stmt->bindValue(5, $report->objetivo);
        $stmt->bindValue(6, $report->plano);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $report->setId(intval($id));
        return $result;
    }

    public function all(): array
    {
        $reportList = $this->pdo
            ->query('SELECT * FROM report;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateReport(...),
            $reportList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM report WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateReport($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateReport(array $ReportData): Report
    {
        $report = new Report($ReportData['id_user'],
            $ReportData['id_personal'],
            $ReportData['id_nutri'],
            $ReportData['dia'],
            $ReportData['objetivo'],
            $ReportData['plano']);
        $report->setId($ReportData['id']);
        return $report;
    }


}

