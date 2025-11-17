<?php

namespace Systemfy\App\Repository;

use PDO;
use Systemfy\App\Database;
use Systemfy\App\Model\Menu;
class MenuRepository
{
    private PDO $pdo;
    function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function add(Menu $menu) : bool
    {
        $sql = "INSERT INTO menu(horario, 
         objetivo,  
         categoria, 
         observação, id_user, id_nutri, titulo) values(?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $menu->horario);
        $stmt->bindValue(2, $menu->objetivo);
        $stmt->bindValue(3, $menu->categoria);
        $stmt->bindValue(4, $menu->observacao);
        $stmt->bindValue(5, $menu->id_user);
        $stmt->bindValue(6, $menu->id_nutri);
        $stmt->bindValue(7, $menu->titulo);

        $result = $stmt->execute();
        $id = $this->pdo->lastInsertId();
        $menu->setId(intval($id));
        return $result;
    }
    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM menu WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function update(Menu $menu): bool
    {
        $sql = 'UPDATE menu SET horario = :horario, 
        objetivo = :objetivo, categoria = :categoria, 
        observacao = :observacao, id_user = :id_user,
        id_nutri = :id_nutri, titulo = :titulo WHERE id = :id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':horario', $menu->horario);
        $stmt->bindValue(':objetivo', $menu->objetivo);
        $stmt->bindValue(':categoria', $menu->categoria);
        $stmt->bindValue(':observacao', $menu->observacao);
        $stmt->bindValue(':id_user', $menu->id_user);
        $stmt->bindValue(':id_nutri', $menu->id_nutri);
        $stmt->bindValue(':titulo', $menu->titulo);
        $stmt->bindValue(':id', $menu->id);

        return $stmt->execute();
    }

    public function all(): array
    {
        $menuList = $this->pdo
            ->query('SELECT * FROM menu;')
            ->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateMenu(...),
            $menuList
        );
    }

    public function find(int $id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM menu WHERE id = ?;');
        $stmt->bindValue(1, $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateMenu($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function hydrateMenu(array $MenuData): Menu
    {
        $menu = new Menu($MenuData['horario'],
            $MenuData['objetivo'],
            $MenuData['categoria'],
            $MenuData['observacao'],
            $MenuData['id_user'],
            $MenuData['id_nutri'],
        $MenuData['titulo']);
        $menu->setId($MenuData['id']);
        return $menu;
    }


}

