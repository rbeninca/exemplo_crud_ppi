<?php 
require_once __DIR__ . '/../Model/DAOUsuario.php';
require_once __DIR__ . ("/../Model/Usuario.php");


class UsuarioController {
    private $daoUsuario;

    public function __construct() {
        $database = new DatabaseMysql(); 
        $db = $database->getConnection();
        $this->daoUsuario = new DAOUsuario();
    }

    public function cadastrarUsuario($nome, $email, $senha, $data_cadastro=null) {
        $usuario = new Usuario();
        
        $usuario->setAll(null, $nome, $email, $senha);
        
        
        return $this->daoUsuario->insertUsuario($usuario);
    }

    public function atualizarUsuario($id, $nome, $email, $senha, $data_cadastro) {
        $usuario = new Usuario();
        $usuario->setAll($id, $nome, $email, $senha, $data_cadastro);
        return $this->daoUsuario->updateUsuario($usuario);
    }

    public function deletarUsuario($id) {
        return $this->daoUsuario->deleteUsuario($id);
    }

    public function buscarUsuario($id) {
        return $this->daoUsuario->getUsuario($id);
    }

    public function listaTodosUsuarios() {

        $usuarios= $this->daoUsuario->getUsuarios();
        /*echo "<pre>";
        echo var_dump($usuarios);
        echo "</pre>"; 
        */
        return $usuarios;
    }
}

?>
