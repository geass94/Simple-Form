<?php
namespace Database;
use PDOException;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $host = MYSQL_HOST;
        $dbname = MYSQL_DATABASE;
        $username = MYSQL_USER;
        $password = MYSQL_PASSWORD;
        $port = MYSQL_PORT;

        $dsn = "mysql:host=$host:$port;dbname=$dbname;charset=utf8mb4";

        $this->connection = new \PDO($dsn, $username, $password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->createTable();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    private function createTable()
    {
        $table = 'entries';

        try {
            $this->connection->exec("CREATE TABLE IF NOT EXISTS $table (
                id INT AUTO_INCREMENT PRIMARY KEY,
                data VARCHAR(255)
            )");
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }
}