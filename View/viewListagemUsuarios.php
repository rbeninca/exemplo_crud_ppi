<style>
#tabela_usuarios,th,td {
    border-collapse: collapse;
    border: 1px solid #ddd;
}
#tabela_usuarios {
    padding: 15px;
    text-align: left;
    width: 100%;

}
#tabela_usuarios thead tr th {
    background-color: #333;
    color: #fff;
    padding: 5px;
}
#tabela_usuarios tbody tr td {
    padding: 10px;
}
/* pinta tabela linha sim linha não */
#tabela_usuarios tbody tr:nth-child(2n) {
    background-color: #f2f2f2;
}
/* houver */
#tabela_usuarios tbody tr:hover {
    background-color: #ddd;
}
/*estiliza links como botões */
#tabela_usuarios tbody tr td a {
    background-color: #333;
    color: #fff;
    padding: 5px;
    text-decoration: none;
    margin:5px;
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
            include_once "../Model/Usuario.php";
            $controller= new  UsuarioController();

            
            $usuarios = $controller->listaTodosUsuarios();
            foreach($usuarios as $usuario){
                echo "<tr>";
                echo "<td>".$usuario->id."</td>";
                echo "<td>".$usuario->nome."</td>";
                echo "<td>".$usuario->email."</td>";
                echo "<td>".$usuario->data_cadastro."</td>";
                echo "<td><a href='telaEditarUsuario.php?id=".$usuario->id."'>Editar</a>";

                echo "<a href='/Rota.php?id=".$usuario->id."&op=excluir_usuario'>Excluir</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>