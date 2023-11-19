<?php  
include_once '../Model/DatabaseMysql.php';
include_once '../Model/DAOUsuario.php';
include_once '../Model/Usuario.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
        // Define o caminho para o arquivo de criação do banco de dados
        $caminhoArquivo = '../init-db.sql'; // Ajuste o caminho conforme necessário
    
        // Verifica se o arquivo existe
        if (!file_exists($caminhoArquivo)) {
            echo "Erro: arquivo SQL não encontrado em: " . $caminhoArquivo;
            return false;
        }
    
        // Carrega o conteúdo do arquivo SQL
        $sql = file_get_contents($caminhoArquivo);
    
        try {
            // Prepara a consulta SQL
            $stmt = $this->conn->prepare($sql);
    
            // Executa a consulta
            $stmt->execute();
    
            // Para scripts de criação/atualização, não é necessário buscar resultados
            return true;
        } catch (PDOException $e) {
            // Imprime a mensagem de erro em caso de exceção
            echo "Erro na execução do SQL: " . $e->getMessage();
            return false;
        }
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
        // Limpa os registros da tabela para teste de inserção.
        $this->trucateDatabase(); 
    
        // Criação de um novo usuário
        $usuario = new Usuario();
        $usuario->setAll(null, "Usuario Teste 0", "usuarioteste1@gmail.com", "123456", "2020-10-10");
    
        // Inserção do usuário no banco de dados
        try {
            $idInserido = $this->daoUsuario->insertUsuario($usuario);
            $usuario->id = $idInserido;
        } catch (Exception $e) {
            return "Erro ao inserir usuário: " . $e->getMessage();
        }
    
        // Recuperação do usuário inserido
        try {
            $usuarioRecuperado = $this->daoUsuario->getUsuario($idInserido);
        } catch (Exception $e) {
            return "Erro ao recuperar usuário: " . $e->getMessage();
        }
    
        // Verificações
        if (!$usuarioRecuperado) {
            return "Usuário não foi recuperado.";
        }
    
        if ($usuarioRecuperado->id != $idInserido) {
            return "ID do usuário não corresponde.";
        }
        if ($usuarioRecuperado->nome != $usuario->nome ||  $usuarioRecuperado->email != $usuario->email || 
            $usuario->senha != $usuarioRecuperado->senha || ($usuario->data_cadastro != substr($usuarioRecuperado->data_cadastro, 0, 10))) {
            return "Dados do usuário não correspondem aos esperados.";
        }
    
        return true;
    }
    
    
    function testeGetUsuario() {
        // Limpa os registros da tabela para garantir um ambiente de teste consistente
        $this->trucateDatabase();        
    
        // Executa o teste de cadastro de usuário
        $resultadoCadastro = $this->testeCadastroUsuario();
        if ($resultadoCadastro !== true) {
            return "Falha no cadastro de usuário: " . $resultadoCadastro;
        }
    
        // Tentativa de recuperar o usuário
        try {
            $usuario = $this->daoUsuario->getUsuario(1);
        } catch (Exception $e) {
            return "Erro ao recuperar usuário: " . $e->getMessage();
        }
    
        // Verifica se o usuário foi recuperado corretamente
        if (!$usuario) {
            return "Usuário não encontrado.";
        }
    
        // Verificações detalhadas dos dados do usuário
        if ($usuario->nome != "Usuario Teste 0" || 
            $usuario->email != "usuarioteste1@gmail.com" ||
            $usuario->senha != "123456"|| 
            substr($usuario->data_cadastro,0,10) != "2020-10-10") {
            return "Dados do usuário recuperado não correspondem.";
        }
    
        return true;
    }
    

    function testeAlteracaoUsuarios() {
        // Limpa os registros da tabela para garantir um ambiente de teste consistente
        $this->trucateDatabase();
    
        // Executa o teste de cadastro de usuário
        $resultadoCadastro = $this->testeCadastroUsuario();
        if ($resultadoCadastro !== true) {
            return "Falha no cadastro de usuário: " . $resultadoCadastro;
        }
    
        // Tentativa de recuperar o usuário
        try {
            $usuario = $this->daoUsuario->getUsuario(1);
        } catch (Exception $e) {
            return "Erro ao recuperar usuário: " . $e->getMessage();
        }
    
        // Alteração dos dados do usuário
        $usuario->nome = "Usuario 1 alterado";
        $usuario->email = "alterado@gmail.com";
        $usuario->senha = "bla"; // Supondo que a senha seja 'hashed'
        $usuario->data_cadastro = "2000-01-01";
    
        // Tentativa de atualizar o usuário
        try {
            $this->daoUsuario->updateUsuario($usuario);
        } catch (Exception $e) {
            return "Erro ao atualizar usuário: " . $e->getMessage();
        }
    
        // Recupera o usuário após a atualização
        try {
            $usuarioAlterado = $this->daoUsuario->getUsuario(1);
        } catch (Exception $e) {
            return "Erro ao recuperar usuário alterado: " . $e->getMessage();
        }
    
        // Verificação dos dados do usuário alterado
        if (!$usuarioAlterado) {
            return "Usuário alterado não encontrado.";
        }
    
        if ($usuarioAlterado->nome != $usuario->nome || 
            $usuarioAlterado->email != $usuario->email ||
            $usuarioAlterado->senha != $usuario->senha|| 
            substr($usuarioAlterado->data_cadastro,0,10) != $usuario->data_cadastro) {
            return "Dados do usuário alterado não correspondem.";
        }
    
        return true;
    }
    

    function testeExclusaoUsuarios() {
        // Limpa os registros da tabela para garantir um ambiente de teste consistente
        $this->trucateDatabase();
    
        // Criação de um novo usuário
        $usuario = new Usuario();
        $usuario->setAll(1, "Usuario Teste 0", "usuarioteste1@gmail.com", "123456", "2020-10-10");
    
        // Inserção do usuário no banco de dados
        try {
            $idInserido = $this->daoUsuario->insertUsuario($usuario);
        } catch (Exception $e) {
            return "Erro ao inserir usuário: " . $e->getMessage();
        }
    
        // Exclusão do usuário
        try {
            $this->daoUsuario->deleteUsuario($idInserido);
        } catch (Exception $e) {
            return "Erro ao excluir usuário: " . $e->getMessage();
        }
    
        // Tentativa de recuperar o usuário excluído
        try {
            $usuarioRecuperado = $this->daoUsuario->getUsuario($idInserido);
        } catch (Exception $e) {
            return "Erro ao recuperar usuário: " . $e->getMessage();
        }
    
        // Verificação se o usuário foi realmente excluído
        if ($usuarioRecuperado === null) {
            return true;
        } else {
            return "Usuário não foi excluído corretamente.";
        }
    }
    function pesquisarUsuarios() {
        $this->trucateDatabase();
        $this->carregaBancoDados();
        $usuarios=$this->daoUsuario->getUsuarioByNome("ar");
        //size of retorna o tamanho do array 6
        if (count($usuarios)==6) {
            return true;
        } else {
            return "Erro ao pesquisar usuários";
        }
    }
}

$testeUsuario = new TesteUsuario($db);


// Função para executar um teste unitário e imprimir o resultado na tela
function executaTeste($teste, $nomeTeste) {
    echo "<pre>";
    try{
        $resultado = $teste->$nomeTeste();
        if ($resultado === true) {
            echo $nomeTeste . ": OK\n";
        } else {
            echo $nomeTeste . ": Falha - " . $resultado . "\n";
            exit();
        }
    } catch (Exception $e) {
        throw new Exception("Falha no testeAlgumMetodo: " . $e->getMessage(), 0, $e);
    }
    echo "</pre>";
       
}

// Chamadas dos testes unitários para a classe DAOUsuario
executaTeste($testeUsuario, 'verificaTabelaExiste');
executaTeste($testeUsuario, 'trucateDatabase');
executaTeste($testeUsuario, 'carregaBancoDados');
executaTeste($testeUsuario, 'testeCadastroUsuario');
executaTeste($testeUsuario, 'testeGetUsuario');
executaTeste($testeUsuario, 'testeAlteracaoUsuarios');
executaTeste($testeUsuario, 'testeExclusaoUsuarios');
executaTeste($testeUsuario, 'carregaBancoDados');
executaTeste($testeUsuario, 'pesquisarUsuarios')

?>
