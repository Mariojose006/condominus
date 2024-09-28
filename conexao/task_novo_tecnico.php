<?php
include('conexao.php');
session_start();

if (isset($_POST['cadastrar'])) {

    $idcondominio = $_POST['idCondominio'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $perfil = $_POST['idPerfil'];
    $senha = $_POST['senha'];

    date_default_timezone_set('America/Sao_Paulo');

    $dataAbertura = date("Y-m-d H:i:s");

    $stmt = $conn->prepare('INSERT INTO tb_usuario (id_condominio, nome, email, telefone,tipo_usuario,senha) VALUES
            (:id_condominio, :nome, :email, :telefone,:tipo_usuario,:senha)');
    $stmt->bindValue(':id_condominio', $idcondominio);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telefone', $telefone);
    $stmt->bindValue(':tipo_usuario', $perfil);
    $stmt->bindValue(':senha', $senha);

    $stmt->execute();

    echo "<script>alert('Usuário cadastrado com Sucesso!);</script>";

    header("location: ../logado/inicial.php");
} else {
    header("location: ../logado/inicial.php");
}
