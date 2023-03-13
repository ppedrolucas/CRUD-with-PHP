<?php 
include('config/conexao.php');
if(isset($_GET['idDel'])){
    $id = $_GET['idDel'];
    $deletar = "DELETE FROM tbusers WHERE idUser=:id";

    try{

        $result = $conect->prepare($deletar);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $contar = $result->rowCount();
        if($contar>0){
            header("Location: home.php");
        }else{
            header("Location: home.php");
        }

    }catch(PDOException $e){
        echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
    }
}