<?php
require_once "./inc/config.php";
class Database
{
    private const DB_NAME = DB_NAME;
    private const DB_HOST = DB_HOST;
    private const DB_USER = DB_USER;
    private const DB_PASSWORD = DB_PASSWORD;
    protected PDO $pdo;
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
