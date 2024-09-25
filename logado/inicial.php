<?php
include('../conexao/conexao.php');
session_start();

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
    <title>Chamados</title>
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
        .chamados {
            width: 100%;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-collapse: collapse;
        }
        .chamados th, .chamados td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .chamados th {
            background-color: #000;
            color: #fff;
        }
        .chamados tr:hover {
            background-color: #f1f1f1;
        }
        .detalhes-link {
            text-decoration: none;
            color: #0000EE;
            font-weight: bold;
        }
        .detalhes-link:hover {
            color: #FF0000;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>
        <?php
            $idUsuario = mysqli_real_escape_string($connection, $_SESSION['idUsuario']);

            $query = "SELECT nome,id_condominio FROM tb_usuario WHERE id_usuario = $idUsuario";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['nome']);
            $idCondominio = $row['id_condominio'];
        ?>
    </h2>
    <h4 style="text-align: center;">
        <?php
            $query = "SELECT nome FROM tb_condominio WHERE id_condominio = $idCondominio";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);

            echo htmlspecialchars($row['nome']);
        ?>

    </h4>
    <a href="novo_chamado.php" class="back-btn">ABRIR CHAMADO</a>
    <a href="../conexao/logout.php">Sair</a>
</div>

<div class="main-content">
    <h1>Chamados</h1>
    <table class="chamados">
        <thead>
            <tr>
                <th>NÚMERO CHAMADO</th>
                <th>DATA DE ABERTURA</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $result = $conn->query("SELECT * FROM tb_chamado");
                $count = $result->rowCount();

                if ($count > 0) {
                    while ($row = $result->fetch(PDO::FETCH_OBJ)){
                        if($row->status == 1){
                            $status = 'Pendente';
                        }else if($row->status == 2){
                            $status = 'Andamento';
                        }else if($row->status == 3){
                            $status = 'Fechado';
                        }
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row->id_chamado); ?></td>
                <td>
                    <?php
                            $data = new DateTime($row->dt_abertura);
                            $data_br = $data->format('d/m/Y H:i:s');
                            echo htmlspecialchars($data_br);
                    ?>
                </td>
                <td><?php echo htmlspecialchars($status); ?></td>
                <td><a href="chamado.php?idChamado=<?php echo $row->id_chamado?>" class="detalhes-link">Ver detalhes &gt;&gt;</a></td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<?php
                
                if($count > 0){
                    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                        echo ($row->id_chamado);
                    }

                }
?>





</body>
</html>