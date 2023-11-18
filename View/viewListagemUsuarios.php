<style>
#tabela_usuarios {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;

}

#tabela_usuarios tbody tr td:nth-child(2) a{
    color: red;
    text-decoration: none;
    margin: 0 5px;
}
</style>
<table id="tabela_usuarios">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Cadastro</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
            //Controller/listaUsuarios.php
            include_once "../Controller/UsuarioController.php";
            $controller= new  UsuarioController();
            
            $usuarios = $controller->listaTodosUsuarios();
            foreach($usuarios as $usuario){
                echo "<tr>";
                echo "<td>".$usuario['id']."</td>";
                echo "<td>".$usuario['nome']."</td>";
                echo "<td>".$usuario['email']."</td>";
                echo "<td>".$usuario['data_cadastro']."</td>";
                echo "<td><a href='telaEditarUsuario.php?id=".$usuario['id']."'>Editar</a>";
                echo "<a href='../Controller/excluirUsuario.php?id=".$usuario['id']."'>Excluir</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>