<?php
namespace Systemfy\App\config;

use PDO;

class database
{
    public static function getConnection(): PDO
    {
        $host = 'localhost:3306';
        $db = 'systemfy';
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8';

        return new PDO(
            "mysql:host=$host;dbname=$db;charset=$charset",
            $user,
            $pass
        );
    }


}