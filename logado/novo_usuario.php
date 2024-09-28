<?php
include('../conexao/conexao.php');
session_start();
$idPerfil = '';
// Verifique se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: ../index.php?error=2");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imgs/icon.jpeg" type="image/png">
    <title>Condôminus - Visualização de Chamado</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #101E38;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
        }

        .sidebar h4 {
            color: white;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
        }

        .sidebar a:hover {
            color: #ff2d00
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
            width: 600px;
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
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #ffff;
            /*pointer-events: none;*/
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .historico-container {
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 20px;
        }

        .historico-item {
            background-color: #e0e0e0;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .historico-item span {
            float: right;
            font-weight: bold;
        }

        .historico-item textarea {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #e0e0e0;
        }

        .select-box {
            width: 100%;
            height: 40px;
            padding: 0 10px;
            border: none;
            border-radius: 4px;
            background-color: #ffff;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            font-size: 16px;
            color: #000;
            cursor: pointer;
        }

        .select-box:focus {
            outline: none;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2><?php
            $idUsuario = mysqli_real_escape_string($connection, $_SESSION['idUsuario']);

            $query = "SELECT * FROM tb_usuario WHERE id_usuario = $idUsuario";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['nome']);
            $idCondominio = $row['id_condominio'];
            $tipoUsuario = $row['tipo_usuario'];
            ?></h2>
        <h4 style="text-align: center;">
            <?php
            $query = "SELECT * FROM tb_condominio WHERE id_condominio = $idCondominio";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);

            echo htmlspecialchars($row['nome']);
            ?>

        </h4>
        <a href="inicial.php" class="back-btn">← VOLTAR</a>
        <a href="../conexao/logout.php">Sair</a>
    </div>

    <form action="../conexao/task_novo_tecnico.php" method="POST" enctype="multipart/form-data">
        <div class="main-content">
            <h1>CADASTRO DE USUÁRIO </h1>
            <div class="form-container">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required><br>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" required><br>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="text" name="email" required><br>
                </div>
                <div class="form-group">
                    <label for="perfil">Perfil:</label>
                    <select id='selecionar-perfil' class='select-box' name='idPerfil'>");
                        <option value='0' <?php if ($idPerfil = '0') ?>>Selecione um perfil</option>
                        <option value='1' <?php if ($idPerfil = '1') ?>>Administrador</option>
                        <option value='2' <?php if ($idPerfil = '2') ?>>Técnico</option>
                        <option value='3' <?php if ($idPerfil = '3') ?>>Cliente</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="senha">Senha :</label>
                    <input type="text" name="senha" required><br>
                </div>
                <script>
                    const select = document.getElementById('selecionar-perfil');

                    select.addEventListener('click', function() {
                        $idPerfil = document.getElementById('selecionar-perfil').value;

                    });
                </script>
                <?php //so aparece se o tipo usuário for de cliente

                echo ("<div class='form-group'>");
                echo ("<label for='selecionar-condominio'>Selecionar condomínio:</label>");
                echo ("<select id='selecionar-condominio' class='select-box' name='idCondominio'>");
                if ($idPerfil == '1') {
                    echo "<option value='1'>-</option>";
                } else {
                    echo ("<option value='0'>Selecione um condomínio</option>");
                    $result = $conn->query("SELECT * FROM tb_condominio");
                    $count = $result->rowCount();
                    if ($count > 0) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                            echo ("<option value='$row->id_condominio'>$row->nome</option>");
                        }
                    }
                }
                echo ("</select>");
                echo ("</div>");

                ?>


                <div class="form-group">
                    <button type='submit' name='cadastrar'>CADASTRAR</button>
                </div>
            </div>
        </div>
    </form>    
    </div>
    </div>
</body>

</html>