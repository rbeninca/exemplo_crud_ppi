<?php // arquivo de configuação da conexão com banco de dados utilizando PDO 

class DatabaseMysql {
    private $host = "mysql";
    private $db_name = "crud_ppi";
    private $username = "root";
    private $password = "rootpass";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
            $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }

   
    
}