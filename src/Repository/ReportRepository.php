<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\config\database;
use Systemfy\App\Model\Report;
class ReportRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = database::getConnection();
    }

    public function add(Report $report) : bool
    {
        $sql = "INSERT INTO report(id_user, id_personal, id_nutri, anotacao, dia, exe_feito, menu_feito, objetivo, plano, titulo) values(?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $report->id_user);
        $stmt->bindValue(2, $report->id_personal);
        $stmt->bindValue(3, $report->id_nutri);
        $stmt->bindValue(4, $report->anotacao);
        $stmt->bindValue(5, $report->dia);
        $stmt->bindValue(6, $report->exe_feito);
        $stmt->bindValue(7, $report->menu_feito);
        $stmt->bindValue(8, $report->objetivo);
        $stmt->bindValue(9, $report->plano);
        $stmt->bindValue(10, $report->titulo);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $report->setId(intval($id));
        return $result;
    }
//    public function remove(int $id): bool
//    {
//        $sql = 'DELETE FROM report WHERE id = ?';
//        $stmt = $this->pdo->prepare($sql);
//        $stmt->bindValue(1, $id);
//
//        return $stmt->execute();
//
//    }

    public function update(Report $report): bool
    {
        $sql = 'UPDATE report SET id_user = :id_user, 
        id_personal= :id_personal, id_nutri= :id_nutri,
        anotacao = :anotacao, dia = :dia, 
        exe_feito = :exe_feito, menu_feito = :menu_feito, objetivo = :objetivo, plano = :plano, titulo = :titulo  WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':id_user', $report->id_user);
        $stmt->bindValue(':id_personal', $report->id_personal);
        $stmt->bindValue(':id_nutri', $report->id_nutri);
        $stmt->bindValue(':anotacao', $report->anotacao);
        $stmt->bindValue(':dia', $report->dia);
        $stmt->bindValue(':exe_feito', $report->exe_feito);
        $stmt->bindValue(':menu_feito', $report->menu_feito);
        $stmt->bindValue(':objetivo', $report->objetivo);
        $stmt->bindValue(':plano', $report->plano);
        $stmt->bindValue(':titulo', $report->titulo);
        $stmt->bindValue(':id', $report->id);

        return $stmt->execute();
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
            $ReportData['anotacao'],
            $ReportData['dia'],
            $ReportData['exe_feito'],
            $ReportData['menu_feito'],
            $ReportData['objetivo'],
            $ReportData['plano'],
        $ReportData['titulo']);
        $report->setId($ReportData['id']);
        return $report;
    }


}

