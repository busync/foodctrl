<?php
namespace App\Database;

use PDO;
use PDOException;
use Exception;
use PDOStatement;

class Database
{
    private PDO $connection;
    
    public function __construct()
    {
        $this->connection = $this->createConnection();
    }
    
    private function createConnection(): PDO
    {
        $host = 'localhost';
        $user = 'root';
        $password = 'root';
        $dbname = 'foodctrl';
        
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        
        return new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    
    public function getConnection(): PDO
    {
        return $this->connection;
    }
    
    public function prepare(string $sql): PDOStatement
    {
        return $this->connection->prepare($sql);
    }
    
    public function query(string $sql): PDOStatement
    {
        return $this->connection->query($sql);
    }
}