<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar de Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_usuario.css">
</head>
<body>
    <?php  include_once("viewMenu.php"); ?>
    <?php  include_once(__DIR__."/../Model/DAUsuario.php");
        
        $usuario = getUser($_GET["id"]);
        if ($usuario == null) {
            echo "<script>alert('Usuario não encontrado!');</script>";
            header("Location: telaListaUsuarios.php");
        }

    
    
    ?>
    <h1>Editar Usuario</h1>1
    <div class="container">   
      <form id="dados_usuarios" action="atualizar_usuario.php" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" placeholder="" value="<?php echo $usuario['id'];?>">
        <label for="name">Nome</label>
        <input type="text" name="nome" id="name" placeholder="Nome" value="<?php echo $usuario['nome'];?>"> 
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email"  value="<?php echo $usuario['email'];?>">
        <label for="password">Senha</label>
        <input type="password" name="senha" id="password" placeholder="Password"  value="<?php echo $usuario['senha'];?>">
        <label for="data_cadastro">Data cadastro</label>
        <input type="date" name="data_cadastro" id="data_cadastro" placeholder="Data cadastro"  value="<?php echo $usuario['data_cadastro'];?>" disabled>  
        <input type="submit" value="Salvar">
    </form>
</div>
</body>
</html>