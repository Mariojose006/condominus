<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'condominus';

    $connection = mysqli_connect($hostname, $username, $password, $database) or die("Não foi possível conectar");
try {
    // cria o objeto PDO de conexão com o servidor de banco de dados 
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // configura os tipos de erros a serem mostrados pelo exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexao efetuada com sucesso!';
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>