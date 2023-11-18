<?php  
include_once '../Model/DatabaseMysql.php';
include_once '../Model/DAOUsuario.php';
include_once '../Model/Usuario.php';

class TesteUsuario {
    private $conn;
    private $daoUsuario;

    public function __construct($db) {
        $this->conn = $db;
        $this->daoUsuario = new DAOUsuario($db);
    }

    function verificaTabelaExiste() {
        /* Verificar se a tabela usuarios existe */ 
        $sql = 'SHOW TABLES LIKE "usuarios"';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
        
    }
    function carregaBancoDados() {
        // Carrega arquivo de criação do banco init-db.sql
        $caminhoArquivo = '../init-db.sql'; // Ajuste o caminho conforme necessário
        $sql = file_get_contents($caminhoArquivo);
        if ($sql === false) {
            // Erro ao ler o arquivo
            return false;
        }
        // Executa o SQL
        $resultado = $this->conn->exec($sql);
        // Verifica se houve algum erro na execução
        if ($resultado === false) {
            // Execução falhou
            return false;
        }
        // Execução bem-sucedida
        return true;
    }

    function trucateDatabase() { 
        // Limpa os registros da tabela para fazer teste de inserção.
        $sql = "TRUNCATE TABLE usuarios";
        $stmt = $this->conn->prepare($sql);
    
        // O sucesso do comando TRUNCATE pode ser verificado pela execução do comando
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    function testeCadastroUsuario() {
        $this->trucateDatabase(); // Limpa os registros da tabela para fazer teste de inserção.
        
        $usuario = new Usuario();
        $usuario->setAll(null, "Usuario Teste 0", "usuarioteste1@gmail.com", "123456", "2020-10-10");
        
        $idInserido = $this->daoUsuario->insertUsuario($usuario);
        
        $usuarioRecuperado = $this->daoUsuario->getUsuario($idInserido);

        if ($usuarioRecuperado && 
            $usuarioRecuperado->id == $idInserido && 
            $usuarioRecuperado->nome == $usuario->nome && 
            $usuarioRecuperado->email == $usuario->email && 
            $usuarioRecuperado->senha == $usuario->senha && 
            $usuarioRecuperado->data_cadastro == $usuario->data_cadastro) {
            return true;
        } else {
            return false;
        }
    }
    
    function testeGetUsuario() {
        $this->trucateDatabase();        
        $this->testeCadastroUsuario();

        $usuario = $this->daoUsuario->getUsuario(1);

        if ($usuario && 
            $usuario->nome == "Usuario Teste 0" && 
            $usuario->email == "usuarioteste1@gmail.com" && 
            $usuario->senha == "123456" && 
            $usuario->data_cadastro == "2020-10-10") {
            return true;
        } else {
            return false;
        }
    }

    function testeAlteracaoUsuarios() {
        $this->trucateDatabase();
        $this->testeCadastroUsuario();

        $usuario = $this->daoUsuario->getUsuario(1);
        $usuario->nome = "Usuario 1 alterado";
        $usuario->email = "alterado@gmail.com";
        $usuario->senha = "alterada";
        $usuario->data_cadastro = "2000-01-01";
        
        $this->daoUsuario->updateUsuario($usuario);
        $usuarioAlterado = $this->daoUsuario->getUsuario(1);

        if ($usuarioAlterado && 
            $usuarioAlterado->nome == "Usuario 1 alterado" && 
            $usuarioAlterado->email == "alterado@gmail.com" && 
            $usuarioAlterado->senha == "alterada" && 
            $usuarioAlterado->data_cadastro == "2000-01-01") {
            return true;
        } else {
            return false;
        }
    }

    function testeExclusaoUsuarios() {
        $this->trucateDatabase();
        $usuario = new Usuario();
        $usuario->setAll(null, "Usuario Teste 0", "usuarioteste1@gmail.com", "123456", "2020-10-10");

        $idInserido = $this->daoUsuario->insertUsuario($usuario);
        $this->daoUsuario->deleteUsuario($idInserido);

        $usuarioRecuperado = $this->daoUsuario->getUsuario($idInserido);

        return $usuarioRecuperado == null;
    }
    function cargaInicialBancoDados(){
        
        //carrega arquivo de criação do banco init-db.sql 

        
        
    }
}

$testeUsuario = new TesteUsuario($db);
assert($testeUsuario->verificaTabelaExiste() == true);
assert($testeUsuario->trucateDatabase() == true);
assert($testeUsuario->carregaBancoDados() == true);
assert($testeUsuario->testeCadastroUsuario() == true);
assert($testeUsuario->testeGetUsuario() == true);
assert($testeUsuario->testeAlteracaoUsuarios() == true);
assert($testeUsuario->testeExclusaoUsuarios() == true);


?>
