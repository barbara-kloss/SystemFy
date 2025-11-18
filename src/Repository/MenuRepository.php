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

    public function add(Menu $menu): bool
    {
        $sql = "INSERT INTO menu(horario, categoria, observacao, id_user, id_nutri, titulo) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $menu->horario, $menu->horario !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(2, $menu->categoria, $menu->categoria !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(3, $menu->observacao, $menu->observacao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(4, $menu->id_user, $menu->id_user !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(5, $menu->id_nutri, $menu->id_nutri !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(6, $menu->titulo, $menu->titulo !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);

        $result = $stmt->execute();
        if ($result) {
            $id = $this->pdo->lastInsertId();
            $menu->setId(intval($id));
        }
        return $result;
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM menu WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(Menu $menu): bool
    {
        $sql = 'UPDATE menu SET 
                horario = :horario, 
                categoria = :categoria, 
                observacao = :observacao, 
                id_user = :id_user, 
                id_nutri = :id_nutri, 
                titulo = :titulo 
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':horario', $menu->horario, $menu->horario !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':categoria', $menu->categoria, $menu->categoria !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':observacao', $menu->observacao, $menu->observacao !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':id_user', $menu->id_user, $menu->id_user !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':id_nutri', $menu->id_nutri, $menu->id_nutri !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindValue(':titulo', $menu->titulo, $menu->titulo !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindValue(':id', $menu->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function all(): array
    {
        $menuList = $this->pdo
            ->query('SELECT * FROM menu ORDER BY id DESC')
            ->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateMenu(...),
            $menuList
        );
    }

    public function find(int $id): ?Menu
    {
        $stmt = $this->pdo->prepare('SELECT * FROM menu WHERE id = ?');
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->hydrateMenu($data);
    }

    public function findByUserId(int $id_user): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM menu WHERE id_user = ? ORDER BY id DESC');
        $stmt->bindValue(1, $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $menuList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(
            $this->hydrateMenu(...),
            $menuList
        );
    }

    public function hydrateMenu(array $menuData): Menu
    {
        $menu = new Menu(
            $menuData['horario'] ?? null,
            isset($menuData['categoria']) && $menuData['categoria'] !== null ? (int) $menuData['categoria'] : null,
            $menuData['observacao'] ?? null,
            isset($menuData['id_user']) && $menuData['id_user'] !== null ? (int) $menuData['id_user'] : null,
            isset($menuData['id_nutri']) && $menuData['id_nutri'] !== null ? (int) $menuData['id_nutri'] : null,
            $menuData['titulo'] ?? null,
            isset($menuData['id']) ? (int) $menuData['id'] : null
        );
        return $menu;
    }
}
