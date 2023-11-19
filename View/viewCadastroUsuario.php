    <!-- Formulario de Castro de novo usuario --> 
    <style>
    #cad_usuario label, #cad_usuario input {
        display: block; 
        min-width: 500px;
     
        margin-bottom: 10px; 
    }
    #cad_usuario input[type="submit"] {
        display:inline-block;
        margin-top: 10px;
        
    }
    #cad_usuario input {
        width: 100%;
        line-height: 30px;
        padding: 5px;
    }
    </style>
    <form id="cad_usuario" action="/Rota.php" method="post">
        <label for="name">Nome</label>
        <input type="text" name="nome" id="name" placeholder="Nome">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
        <label for="password">Senha</label>
        <input type="password" name="senha" id="password" placeholder="Password">
        <label for="passoword">Confirmação senha</label>
        <input type="password" name="senha_confirma" id="password" placeholder="Password">
        <input type="submit" value="cadastrar">
    </form>