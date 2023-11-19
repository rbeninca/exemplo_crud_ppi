# Projeto CRUD PPI

Este projeto implementa um sistema CRUD (Create, Read, Update, Delete) para manipulação de usuários. O sistema é implementado em PHP e utiliza o banco de dados MySQL.

## Estrutura do Projeto

O projeto é dividido em duas partes principais: Model e View.

### Model

O diretório Model contém o arquivo `DAUsuario.php`, que define funções para manipular usuários no banco de dados. As funções incluem `conectar()`, `getAllUser()`, `getUser($id)`, `insertUser($nome, $email, $senha)`, `updateUser($id, $nome, $email, $senha)` e `deleteUser($id)`.

### View

O diretório View contém os arquivos PHP que implementam a interface do usuário e a lógica de negócios.

- `cadastrar_usuario.php`: Este arquivo lida com a criação de um novo usuário. Ele recupera os dados do usuário de uma requisição POST e chama a função `insertUser()` para inserir o usuário no banco de dados.

- `telaCadastrarUsuario.php`: Este arquivo exibe o formulário de cadastro de usuários. Ele preenche os campos do formulário com os valores existentes do usuário, se disponíveis.

- `telaEditarUsuario.php`: Este arquivo exibe o formulário de edição de usuários. Ele preenche os campos do formulário com os valores existentes do usuário, se disponíveis.

- `telaListarUsuarios.php`: Este arquivo exibe uma tabela com todos os usuários cadastrados no banco de dados. Ele também inclui links para editar e excluir usuários.
