<?php
    include_once '../Model/DatabaseMysql.php';
    
    /* Código que implementa um teste de conexão com o banco de dados */
    $database = new DatabaseMysql();
    $db = $database->getConnection();
    if($db) {
        echo "Conexão realizada com sucesso!";
    } else {
        echo "Erro ao conectar com o banco de dados!";
    }
    echo "<br>";
?>