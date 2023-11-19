<?php
    include_once('Controller/UsuarioController.php');

//op  cadastro_usuario, excluir_usuario, editar_usuario , listar_usuarios, get_usuario
     $method_request=$_SERVER["REQUEST_METHOD"];


     switch ($method_request){
        case "GET":
            $op=$_GET["op"];
            switch ($op){
                case "listar_usuarios":
                    $usuarioController = new UsuarioController();
                    $usuarios = $usuarioController->listaTodosUsuarios() ;
                    echo json_encode($usuarios);
                    break;
                case "get_usuario":
                    $id=$_GET["id"];
                    $usuarioController = new UsuarioController();
                    $usuario = $usuarioController->buscarUsuario($id);
                    echo json_encode($usuario);
                    break;
                case "excluir_usuario":
                    $id=$_GET["id"];
                    $usuarioController = new UsuarioController();
                    $usuario = $usuarioController->deletarUsuario($id);
                    header("Location: /View/telaListaUsuarios.php");
                    break;
            }
            break;
        case "POST":
            //verifica se os dados para cadastro foram recebidos por post   
            if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['op']) && $_POST['op']=='cadastro_usuario' ) {
                
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                $usuarioController=new UsuarioController();
                $id = $usuarioController->cadastrarUsuario($nome, $email, $senha);
                header('Location: /View/telaListaUsuarios.php');
            

            }if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['op']) && $_POST['op']=='editar_usuario' ) {
                $id=$_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $data_cadastro = $_POST['data_cadastro'];
                
                $usuarioController=new UsuarioController();
                $id = $usuarioController->atualizarUsuario($id, $nome, $email, $senha, $data_cadastro);
                header('Location: /View/telaListaUsuarios.php');
            break;    
            }
        }
    