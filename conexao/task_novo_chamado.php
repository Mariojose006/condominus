<?php
    include('conexao.php');
    session_start();

    if(isset($_POST['register'])) {

        $descricao = $_POST['descricao'];
        $idUsuario = $_SESSION['idUsuario'];

        date_default_timezone_set('America/Sao_Paulo');

        $dataAbertura = date("Y-m-d H:i:s");
                
        $stmt = $conn->prepare('INSERT INTO tb_chamado (id_tecnico, id_usuario_solicitante, descricao, dt_abertura, status) VALUES
            (:id_tecnico, :id_usuario_solicitante, :descricao, :dt_abertura, :status)');
                $stmt->bindValue(':id_tecnico', 1);
                $stmt->bindValue(':id_usuario_solicitante', $idUsuario);
                $stmt->bindValue(':descricao', $descricao);
                $stmt->bindValue(':dt_abertura', $dataAbertura);
                $stmt->bindValue(':status', 1);

                $stmt->execute();

                echo "<script>alert('Chamado cadastrado com Sucesso!);</script>";

                header("location: ../logado/inicial.php");
    }else{
        header("location: ../logado/inicial.php");
    }
?>