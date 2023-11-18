<?php
    include_once '../Model/DatabaseMysql.php';
    include_once '../Model/DAOUsuario.php';
    include_once '../Model/Usuario.php';
    include_once '../Controller/UsuarioController.php';

//op  cadastro_usuario, excluir_usuario, editar_usuario , listar_usuarios, get_usuario
     $method_request=$_SERVER["REQUEST_METHOD"];


     switch ($method_request){
        case "GET":
            $op=$_GET["op"];
            switch ($op){
                case "listar_usuarios":
                    $usuarioController = new UsuarioController();
                    $usuarios = $usuarioController->buscarTodosUsuarios();
                    echo json_encode($usuarios);
                    break;
                case "get_usuario":
                    $id=$_GET["id"];
                    $usuarioController = new UsuarioController();
                    $usuario = $usuarioController->buscarUsuario($id);
                    echo json_encode($usuario);
                    break;
            }
            break;
        case "POST":
            //cadastro_usuario
            $usuarioController = new UsuarioController();
            //verifica se os dados para cadastro foram recebidos por post   
            if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['data_cadastro'])) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $data_cadastro = $_POST['data_cadastro'];
                $id = $usuarioController->cadastrarUsuario($nome, $email, $senha, $data_cadastro);
                header('Location: ../View/viewListagemUsuarios.php');
            
            }
            break;    
            case 'PUT':
                $usuarioController = new UsuarioController();
                if ( isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['data_cadastro'])) {
                    $id=$_POST['id'];
                    $nome= $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $data_cadastro = $_POST['data_cadastro'];

                    $usuarioController->atualizarUsuario($id, $_POST['nome'], $email, $senha, $data_cadastro) ;
                }
                break;
            case 'DELETE':
                $usuarioController = new UsuarioController();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuarioController->deletarUsuario($id);
                }
                break;
        }
