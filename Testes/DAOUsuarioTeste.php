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
        // Restante do método permanece igual
    }

    function trucateDatabase() { 
        // Restante do método permanece igual
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
        $this->trucateDatabase();
        //load string criação do banco de dados e tabelas 
        $dados = 
    }
}

$testeUsuario = new TesteUsuario($db);
assert($testeUsuario->verificaTabelaExiste() == true);
assert($testeUsuario->trucateDatabase() == true);
assert($testeUsuario->testeCadastroUsuario() == true);
assert($testeUsuario->testeGetUsuario() == true);
assert($testeUsuario->testeAlteracaoUsuarios() == true);
assert($testeUsuario->testeExclusaoUsuarios() == true);

?>
