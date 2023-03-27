<?php

class Database
{
    // Данные подключения
    private $host = "localhost";
    private $db_name = "library";
    private $username = "root";
    private $password = "";
    public $conn;

    // создание соединения с БД
    public function getConnection(): ?PDO
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Ошибка подключения: " . $exception->getMessage();
        }

        return $this->conn;
    }
}