<?php
session_start();
class Crud
{
    private $conn;
    private $table_name = "usuario";
    private $db_name = "final";
    private $id;
    public function __construct($db)
    {
        $this->conn = $db;
    }

// -----------------------------------------------------------------------------------------------



    public function read()
    {
        $query = "SELECT * FROM ". $this->db_name .".". $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }



// --------------------------------------------------------------------------------------------------------


    public function update($nome, $email, $senha, $id)
    {
        $query = "UPDATE corujao." . $this->table_name . " SET NomeUsu = ?, EmailUsu = ?, SenhaUsu = ? WHERE idUsu = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $email, $senha, $id]);
        return $stmt;
    }
    public function updateForTime($time, $id)
    {
        $query = "UPDATE corujao.usuario SET Times_idTime = ? WHERE idUsu = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$time, $id]);
        var_dump($stmt);
        return $stmt;
    }

    public function delete($id)
    {
        $query = "DELETE FROM corujao." . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
    public function validate($email, $senha){
        
        try {

        $stmt = $this->conn->prepare("SELECT * FROM corujao.usuario WHERE EmailUsu = :username  ");
            $stmt->bindParam(':username', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && $senha == $user['SenhaUsu']) {
                // Login bem-sucedido
                $_SESSION['username'] = $user['NomeUsu'];
                return true;
            } else {
                // Credenciais inválidas
                return false;
            }
        } catch (PDOException $e) {
             echo "Erro no login: " . $e->getMessage();
        }
    }
    
    public function validateEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    public function insert($nome, $senha){

        $query = "INSERT INTO " . $this->db_name.".". $this->table_name . " (login, senha) VALUES
        (?, ?)";
        $stmt = $this->conn->prepare($query); 
        $stmt->execute([$nome, $senha]);

        return $stmt;

    }
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
}

    