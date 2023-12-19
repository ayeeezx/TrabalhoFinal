<?php
class Database
{
    private $host = "localhost";
    private $fullstack = "fullstack";
    private $usuario = "root";
    private $senha = "";
    public $conn;
    public function getConnection()
    {

        try {
            $this->conn = new PDO("mysql:host=" . $this->host .
                ";dbname=" . $this->fullstack, $this->usuario, $this->senha);
        } catch (PDOException $exception) { 
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
        
    }
}
