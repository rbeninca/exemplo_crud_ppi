<!-- Formulario de edição usuario --> 
<style>
    #edit_usuario label, #cad_usuario input {
        display: block; 
        margin-bottom: 10px; 
        min-width: 500px;
     
    }
    #edit_usuario input[type="submit"] {
        display:inline-block;
        margin-top: 10px;
    }
    
    
    </style>

    <?php 
        require_once __DIR__ . '/../Controller/UsuarioController.php';
        $id = $_GET['id'];
        $usuarioController = new UsuarioController();
        $usuario = $usuarioController->buscarUsuario($id);
    ?>
    
    <form id="edit_usuario" action="/Rota.php" method="POST">
        <label for="id">Id</label>
        <input name="id" value=<?php echo $usuario->id;?>>
        <label for="name">Nome</label>
        <input type="text" name="nome" id="name" placeholder="Nome" value=<?php echo $usuario->nome;?> >
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" value=<?php echo $usuario->email;?>>
        <label for="password">Senha</label>
        <input type="password" name="senha" id="password" placeholder="Password"  value=<?php echo $usuario->senha;?>>
        <label for="data_cadastro">Data Cadastro</label>
        <input type="text" name="data_cadastro" id="data_cadastro" placeholder="Data Cadastro"  value=<?php echo $usuario->data_cadastro;?>>
        <input type="hidden" name="op" value="editar_usuario">
        
        <input type="submit" value="Salvar">
    </form>