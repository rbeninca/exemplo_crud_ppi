<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Formulario de Login -->
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="submit" value="Iniciar Sesión">
    </form>
    
    <!-- Formulario de Castro de novo usuario --> 
    <form action="viewCadastroUsuario.php" method="post">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Nombre">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="submit" value="Registrarse">
    </form>

</body>

</html>