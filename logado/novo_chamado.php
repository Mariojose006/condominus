<?php
include('../conexao/conexao.php');
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condôminus - Cadastro de Chamado</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #b3c6ff;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar h2 {
            color: #000;
            text-align: center;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #000;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #fff;
            color: #4CAF50;
        }
        .sidebar a.back-btn {
            background-color: #007BFF;
            color: #fff;
            padding: 15px;
            font-weight: bold;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .main-content h1 {
            background-color: #000;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .form-container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="file"] {
            display: block;
            margin-top: 10px;
        }
        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2><?php 
            $idUsuario = mysqli_real_escape_string($connection, $_SESSION['idUsuario']);

            $query = "SELECT nome,id_condominio FROM tb_usuario WHERE id_usuario = $idUsuario";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['nome']);
            $idCondominio = $row['id_condominio'];
        ?></h2>
    <h4 style="text-align: center;">
        <?php
            $query = "SELECT nome FROM tb_condominio WHERE id_condominio = $idCondominio";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);

            echo htmlspecialchars($row['nome']);
        ?>

    </h4>
    <a href="inicial.php" class="back-btn">← VOLTAR</a>
</div>

<div class="main-content">
    <h1>DADOS DO CHAMADO</h1>
    <div class="form-container">
        <form action="../conexao/task_novo_chamado.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="resumo">Descrição:</label>
                <textarea id="resumo" name="descricao" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="register">CADASTRAR</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
