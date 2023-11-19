<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form_usuario.css">
</head>
<body>
    <?php  include_once("viewMenu.php"); ?>
    <h1>Cadastrar Usuarios</h1>
    <div class="conatiner">
        <h1>Sobre o Crud</h1>
        <p>Crud desenvolvido para a disciplina de Programação Web, tem como objetivo sem um exemplo simples de desenvolvimento de CRUD em php. Por isso diversas simplificações foram feitas entre elas a implementação do modelo não OO e sem tratamento de requisições ou sanitizações</p>
        <h2>Os arquivos</h2>
        <p>Os arquivos estão dipposto em arquivos </p>
        <pre>
            ./View  -Pasta com arquivos de visão e controle
            ./View/form_usuario.css   -css de estilização do formulario dados do usuario
            ./View/telaEditarUsuario.php -Tela de edição de usuario
            ./View/excluir_usuario.php  -arquivo que implmenta a realizção da excluir_usuario
            ./View/cadastrar_usuario.php -arquivo que implmenta a realização do cadastro de usuario
            ./View/viewMenu.php -arquivo que implementa o menu de navegação
            ./View/viewListagemUsuarios.php -arquivo que implementa a listagem de usuarios
            ./View/telaListaUsuarios.php -arquivo que implementa a tela de listagem de usuarios
            ./View/telaCadastrarUsuario.php -arquivo que implementa a tela de cadastro de usuarios
            ./View/style.css -arquivo de estilização geral
            ./View/tela_sobre.php -arquivo que implementa a tela sobre
            ./index.php -arquivo que implementa a tela inicial
            ./Model 
            ./Model/DAUsuario.php
            ./Dockerfile --arquivo de configuração do docker para o php
            ./docker-compose.yml --arquivo de configuração do docker para o php 
            ./init-db.sql --arquivo de configuração do banco de dados e inicialização
    </div>
</body>
</html>