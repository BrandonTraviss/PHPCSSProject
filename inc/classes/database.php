<?php
require_once "../config.php";
class Database
{
    // Connection constants
    private const DB_NAME = 'your_database_name';
    private const DB_HOST = 'localhost';
    private const DB_USER = 'your_username';
    private const DB_PASSWORD = 'your_password';

    // Private PDO instance
    private PDO $pdo = null;

    // Constructor initializes the PDO connection
    public function __construct()
    {
        $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

        try {
            $this->pdo = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new RuntimeException('Database connection failed: ' . $e->getMessage());
        }
    }
}
