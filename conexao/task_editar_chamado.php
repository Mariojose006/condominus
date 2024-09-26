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

    if(isset($_POST['iniciar'])) {
        //$destinyTime = $_POST['destinyTime'];
        $idChamado = $_GET['idChamado'];
        
        $stmt = $conn->prepare("UPDATE tb_chamado SET status = :status WHERE id_chamado = :id_chamado");
        
        $stmt->bindValue(':id_chamado', $idChamado, PDO::PARAM_INT);
        $stmt->bindValue(':status', 2, PDO::PARAM_INT);
        $stmt->execute();

        header("location: ../logado/chamado.php?idChamado=$idChamado");
    }


    if(isset($_POST['comentario'])) {
        //$destinyTime = $_POST['destinyTime'];
        $idTecnico = $_GET['idTecnico'];
        $idChamado = $_GET['idChamado'];
        $descricaoComentario = $_POST['descricaoComentario'];
        
        date_default_timezone_set('America/Sao_Paulo');
        $dataComentario = date("Y-m-d H:i:s");

        $stmt = $conn->prepare('INSERT INTO tb_comentario (id_tecnico, id_chamado, dt_comentario, descricao) VALUES
            (:id_tecnico, :id_chamado, :dt_comentario, :descricao)');
                $stmt->bindValue(':id_tecnico', $idTecnico);
                $stmt->bindValue(':id_chamado', $idChamado);
                $stmt->bindValue(':dt_comentario', $dataComentario);
                $stmt->bindValue(':descricao', $descricaoComentario);

                $stmt->execute();

        $stmt = $conn->prepare("UPDATE tb_chamado SET status = :status WHERE id_chamado = :id_chamado");
        
        $stmt->bindValue(':id_chamado', $idChamado, PDO::PARAM_INT);
        $stmt->bindValue(':status', 3, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('Comentário efetuado com Sucesso!);</script>";

        header("location: ../logado/chamado.php?idChamado=$idChamado");
        
    }

    if(isset($_POST['transferir'])) {
        $idTecnico = $_POST['idNovoTecnico'];
        if($idTecnico != 0){
            $idChamado = $_GET['idChamado'];
            
            $stmt = $conn->prepare("UPDATE tb_chamado SET id_tecnico = :id_tecnico WHERE id_chamado = :id_chamado");
            
            $stmt->bindValue(':id_chamado', $idChamado, PDO::PARAM_INT);
            $stmt->bindValue(':id_tecnico', $idTecnico, PDO::PARAM_INT);
            $stmt->execute();

            header("location: ../logado/chamado.php?idChamado=$idChamado");
        }
    }


?>