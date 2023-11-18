    <!-- Formulario de Castro de novo usuario --> 
    <form action="../Controller/Rota.php" method="POST">
        <label for="name">Nombre</label>
        <input type="text" name="nome" id="name" placeholder="Nombre">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
        <label for="password">Password</label>
        <input type="password" name="senha" id="password" placeholder="Password">
        <input type="submit" value="cadastrar">
    </form>