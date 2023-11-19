<?php 
require_once __DIR__ . ('/../Model/DatabaseMysql.php');
require_once __DIR__ .  ('/Usuario.php');

class DAOUsuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $this->conn = (new DatabaseMysql())->getConnection();
    }

    function insertUsuario(Usuario $usuario): int {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, senha, data_cadastro) VALUES (:nome, :email, :senha, :data_cadastro)";
        $stmt = $this->conn->prepare($query);

        // Preparar os dados para inserção
        $usuario->nome = htmlspecialchars(strip_tags($usuario->nome));
        $usuario->email = htmlspecialchars(strip_tags($usuario->email));
        $usuario->senha = htmlspecialchars(strip_tags($usuario->senha));
          //dt hora atual get current date time system
          date_default_timezone_set('America/Sao_Paulo');
        $usuario->data_cadastro = date('Y-m-d H:i:s');
        // Vincular os parâmetros
        $stmt->bindParam(":nome", $usuario->nome);
        $stmt->bindParam(":email", $usuario->email);
        $stmt->bindParam(":senha", $usuario->senha);
        $stmt->bindParam(":data_cadastro", $usuario->data_cadastro);
        
        // Executar a query
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        } else {
            return -1;
        }
    }

    function updateUsuario(Usuario $usuario): bool {
        $query = "UPDATE " . $this->table_name . " SET nome=:nome, email=:email, senha=:senha, data_cadastro=:data_cadastro WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Preparar os dados para atualização
        $usuario->nome = htmlspecialchars(strip_tags($usuario->nome));
        $usuario->email = htmlspecialchars(strip_tags($usuario->email));
        $usuario->senha = htmlspecialchars(strip_tags($usuario->senha));
        $usuario->data_cadastro = htmlspecialchars(strip_tags($usuario->data_cadastro));

        // Vincular os parâmetros
        $stmt->bindParam(":nome", $usuario->nome);
        $stmt->bindParam(":email", $usuario->email);
        $stmt->bindParam(":senha", $usuario->senha);
        $stmt->bindParam(":data_cadastro", $usuario->data_cadastro);
        $stmt->bindParam(":id", $usuario->id);
        return $stmt->execute();
    }

    function deleteUsuario($id): bool {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    function getUsuario($id): ?Usuario {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
            $stmt = $this->conn->prepare($query);
    
            // Vinculação direta do ID é segura com consultas preparadas
            $stmt->bindParam(":id", $id);
            $stmt->execute();
    
            $u = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($u) {
                $usuario = new Usuario();
                $usuario->setAll($u['id'], $u['nome'], $u['email'], $u['senha'], $u['data_cadastro']);
                return $usuario;
            }
            return null;
        } catch (PDOException $e) {
            // Tratamento de erro ou log
            throw new Exception("Erro ao buscar usuário: " . $e->getMessage());
        }
    }
    

    function getUsuarios(): Array {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $arrayUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayObjUsuarios = [];
        foreach ($arrayUsuarios as $usuario) {
            $objUsuario = new Usuario();
            $objUsuario->setAll($usuario['id'], $usuario['nome'], $usuario['email'], $usuario['senha'], $usuario['data_cadastro']);
            array_push($arrayObjUsuarios, $objUsuario);
        }
        return $arrayObjUsuarios;
    }

    function getUsuarioByNome($nome): Array {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nome LIKE :nome";
        $stmt = $this->conn->prepare($query);

        $nome = htmlspecialchars(strip_tags($nome));
        $nomeLike = "%".$nome."%";
        $stmt->bindParam(":nome", $nomeLike);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = [];
        foreach ($result as $row) {
            $usuario = new Usuario();
            $usuario->setAll($row['id'], $row['nome'], $row['email'], $row['senha'], $row['data_cadastro']);
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }
}
?>
