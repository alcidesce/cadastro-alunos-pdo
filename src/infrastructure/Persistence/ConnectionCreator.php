<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO {
        
        $databasePath = __DIR__ . '/../../../banco.sqlite';        
        $pdo = new PDO('sqlite:'.$databasePath);
        
        return $pdo;
        
    }
}