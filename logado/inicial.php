<?php
//session_start();

// Verifique se o usuário está logado
//if (!isset($_SESSION['user'])) {
    // Se não estiver logado, redirecione para a página de login
//    header("Location: index.php");
//    exit();
//}

// Exemplo de dados de chamados
$chamados = [
    ['numero' => '001', 'status' => 'Em andamento'],
    ['numero' => '002', 'status' => 'Pendente'],
    ['numero' => '003', 'status' => 'Concluído'],
    ['numero' => '004', 'status' => 'Em andamento'],
    ['numero' => '005', 'status' => 'Pendente'],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condôminus - Seus Chamados</title>
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
            //echo htmlspecialchars($_SESSION['user']);
            echo "Álvaro"; 
        ?>
    </h2>
    <h4 style="text-align: center;">Condomínio Flor de Liz</h4>
    <a href="#">ABRIR CHAMADO</a>
    <!--<a href="#">TÉCNICOS PARCEIROS</a>-->
</div>

<div class="main-content">
    <h1>Seus Chamados</h1>
    <table class="chamados">
        <thead>
            <tr>
                <th>NÚMERO CHAMADO</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chamados as $chamado): ?>
            <tr>
                <td><?php echo htmlspecialchars($chamado['numero']); ?></td>
                <td><?php echo htmlspecialchars($chamado['status']); ?></td>
                <td><a href="#" class="detalhes-link">Ver detalhes &gt;&gt;</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
