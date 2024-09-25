<?php
    include('conexao.php');

    if(isset($_POST['finalizar'])) {
        //$destinyTime = $_POST['destinyTime'];
        $idChamado = $_GET['idChamado'];

        $stmt = $conn->prepare("UPDATE tb_chamado SET status = :status WHERE id_chamado = :id_chamado");
        
        $stmt->bindValue(':id_chamado', $idChamado, PDO::PARAM_INT);
        $stmt->bindValue(':status', 3, PDO::PARAM_INT);
        $stmt->execute();

        header("location: ../logado/chamado.php?idChamado=$idChamado");
        
    }
?>