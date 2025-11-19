<?php
namespace Systemfy\App;

use PDO;
use PDOException; // Importar a exceção

class Database // <--- CORRIGIDO: D maiúsculo
{
    public static function getConnection(): PDO
    {
        $host = 'localhost:3306'; // Mantenha a porta aqui se não for a padrão (3306)
        $db = 'systemfy';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // Adicionando tratamento de erro
        try {
            $pdo = new PDO($dsn, $user, $pass);
            // Configura o PDO para lançar exceções em caso de erro SQL
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Configura para retornar BLOBs como strings em vez de recursos
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, true);
            return $pdo;
        } catch (PDOException $e) {
            // Se falhar a conexão, exibe a mensagem de erro detalhada e interrompe
            die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }
}