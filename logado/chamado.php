<?php
    include('../conexao/conexao.php');
    session_start();

    // Verifique se o usuário está logado
    if (!isset($_SESSION['idUsuario'])) {
        // Se não estiver logado, redirecione para a página de login
        header("Location: ../index.php?error=2");
        exit();
    }

    $idChamado = $_GET['idChamado'];

    $query = "SELECT * FROM tb_chamado WHERE id_chamado = $idChamado";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    $data = new DateTime($row['dt_abertura']);
    $dataAbertura = $data->format('d/m/Y H:i:s');

    //$data = new DateTime($row['dt_fechamento']);
    //$dataFechamento = $data->format('d/m/Y H:i:s');

    $descricao = $row['descricao'];
    $idSolicitante = $row['id_usuario_solicitante'];
    $idTecnico = $row['id_tecnico'];

    if($row['status'] == 1){
        $status = 'Pendente';
    }else if($row['status'] == 2){
        $status = 'Andamento';
    }else if($row['status'] == 3){
        $status = 'Fechado';
    }

    $query = "SELECT * FROM tb_usuario WHERE id_usuario = $idTecnico";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    $nomeTecnico = $row['nome'];

    $query = "SELECT * FROM tb_usuario WHERE id_usuario = $idSolicitante";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    
    $nomeSolicitante = $row['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group textarea{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #e0e0e0;
            pointer-events: none;
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

    <form action="../conexao/task_editar_chamado.php?idChamado=<?php echo $idChamado; ?>&idTecnico=<?php echo $_SESSION['idUsuario']?>" method="POST" enctype="multipart/form-data">
    <div class="main-content">
    
        <h1>CHAMADO <?php echo $idChamado?></h1>
        <div class="form-container">
            <div class="form-group">
                <label for="aberto_por">Aberto por:</label>
                <input type="text" id="aberto_por" value="<?php echo $nomeSolicitante; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="descricao_problema">Descrição do Problema:</label>
                <textarea id="descricao_problema" rows="4" readonly><?php echo htmlspecialchars($descricao); ?></textarea>
            </div>
            <div class="form-group">
                <label for="responsavel">Responsável:</label>
                <input type="text" id="responsavel" value="<?php echo $nomeTecnico; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="responsavel">Status:</label>
                <input type="text" id="responsavel" value=" <?php echo htmlspecialchars($status); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="responsavel">Abertura:</label>
                <input type="text" id="responsavel" value=" <?php echo htmlspecialchars($dataAbertura); ?>" readonly>
            </div>



            <?php //so aparece se o chamado não estiver fechado 
                if($status != 'Fechado' && $tipoUsuario == 1){
                    echo ("<div class='form-group'>");
                    echo ("<label for='transferir-tecnico'>Transferir Chamado para:</label>");
                    
                    echo ("<select id='transferir-tecnico' name='idNovoTecnico'>");
                        echo ("<option value='0'>Selecione um técnico</option>");
                        $result = $conn->query("SELECT * FROM tb_usuario WHERE tipo_usuario = 2");
                        $count = $result->rowCount();
                        if ($count > 0) {
                            while ($row = $result->fetch(PDO::FETCH_OBJ)){
                                echo ("<option value='$row->id_usuario'>$row->nome</option>");
                            }
                        }

                    echo ("</select>");
                    echo ("</div>");
            
                        echo("<div class='form-group'>");
                            echo ("<button type='submit' name='transferir'>Transferir</button>");
                        echo ("</div>");
                }
            
            
            
            ?>
            
            <?php ?>

            <div class="historico-container">
                <h3>Histórico:</h3>
                <?php
                    $result = $conn->query("SELECT * FROM tb_comentario where id_chamado = $idChamado");
                    $count = $result->rowCount();
                    if ($count > 0) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)){
                            $data = new DateTime($row->dt_comentario);
                            $data = $data->format('d/m/Y H:i:s');
                ?>
                    <div class="historico-item">
                        <p><?php echo htmlspecialchars($row->descricao); ?></p>
                        <span><?php echo htmlspecialchars($data); ?></span>
                    </div>
                <?php 
                        }
                    } 
                ?>

                
                
                    <div class="historico-item">
                        
                    <?php
                        if($status != 'Fechado' && $status != 'Pendente'){
                            echo ("<label for='descricao_problema'>Novo comentário:</label>");
                            echo ("<textarea id='descricao_problema' rows='4' name='descricaoComentario'></textarea>");
                        }
                    ?>



                    </div>
            </div>

            
                <div class="form-group">
                    <?php 
                        //se finalizado não aparece
                        if($status != 'Fechado' && $status != 'Andamento' && $tipoUsuario != 3){
                            echo ("<button type='submit' name='iniciar'>INICIAR ATENDIMENTO</button>");
                        }
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        //se finalizado não aparece
                        if($status != 'Fechado' && $status != 'Pendente' && $tipoUsuario != 3){
                            echo ("<button type='submit' name='comentario'>EFETUAR COMENTÁRIO</button>");
                        }
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        //se já finalizado não aparece
                        if($status != 'Fechado' && $status != 'Pendente' && $tipoUsuario != 3){
                            echo ("<button type='submit' name='iniciar'>FINALIZAR</button>");
                        }
                    ?>
                </div>
    </form>

    </div>
</div>

</body>
</html>
