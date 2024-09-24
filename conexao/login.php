<?php
    include('conexao.php');

    // recebe os dados do formulário
    $login = mysqli_real_escape_string($connection, $_POST['login']);
    $senha = mysqli_real_escape_string($connection, $_POST['senha']);
    $senha = md5($senha); // Criptografa a senha com MD5

    // Pesquisa na tabela de usuários
    $query = "SELECT * FROM tb_usuario WHERE email = '{$login}' AND senha = '{$senha}'";
    $result = mysqli_query($connection, $query);

    // Verifica se a consulta retornou algum registro
    if (mysqli_num_rows($result) == 1) {
        session_start();

        // Busca o id do usuário
        $row = mysqli_fetch_assoc($result);
        $_SESSION['idUsuario'] = $row['id_usuario'];

        echo("Login efetuado com sucesso!");
        header("Location: ../logado/inicial.php");
        exit(); // Certifique-se de sair do script após o redirecionamento
    } else {
        // Inicializa a sessão
        session_start();
        // Limpa a sessão
        $_SESSION = array(); 
        // Destroi a sessão
        session_destroy();

        // Redireciona para a página de erro de login
        echo("Login não foi efetuado com sucesso!");
        header("Location: ../index.php?error=1");
    }
?>
