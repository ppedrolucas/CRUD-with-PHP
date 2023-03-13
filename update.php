<?php
ob_start(); //ARMAZENA MEUS DADOS EM CACHE
session_start(); //INICIA A SESSÃO
if(isset($_SESSION['loginUser']) && (isset($_SESSION['senhaUser']))){
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprendendo PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php
        
        include_once('config/conexao.php');
        if(!isset($_GET['id'])){
        header("Location: home.php");
        exit;
         }
         $id = filter_input(INPUT_GET, 'id',FILTER_DEFAULT);

         $select = "SELECT * FROM tbusers WHERE idUser=:id";
         try{
            $resultado = $conect->prepare($select);
            $resultado->bindParam(':id',$id, PDO::PARAM_INT);
            $resultado->execute();

            $contar = $resultado->rowCount();
            if($contar>0){
                while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
                    $idUs = $show->idUser;
                    $nomeUs = $show->nameUser;
                    $emailUs = $show->emailUser;
                    $passUs = $show->passUser;
                    $fotoUs = $show->fotoUser;
                }
            }else{
                echo '<div class="container">
                            <div class="alert alert-danger" role="alert">
                                OK Usuário editado!
                            </div>
                        </div>';
            }
         }catch (PDOExceptio $e){
            echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
        }
        ?>
        <div class="row">
        <div class="col-lg-4">
            <a href="home.php">Voltar</a>
        </div>
            <div class="col-lg-4">
            <form action="" method="post" enctype="multipart/form-data">
                    <h2>Formulário</h2>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo $nomeUs?>">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $emailUs?>">
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="pass" class="form-control" value="<?php echo $passUs?>">
                    </div>
                    <div class="form-group">
                        <label>Foto:</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <hr>
                    <button type="submit" name="btnE" class="btn btn-primary">Enviar</button>
                </form>
                <?php
                
                    
                    if(isset($_POST['btnE'])) {
                        $nome=$_POST['nome'];
                        $email=$_POST['email'];
                        $pass=$_POST['pass'];
                       
                        if(!empty($_FILES['foto']['name'])){

                       $formaP = array("png","jpg","JPG","jpeg","gif",);//Formatos permitidos
                       $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);//Extrair a extensão

                       if(in_array($extensao, $formaP)){
                        $pasta = "img/salvos/";//Salvar em uma pasta
                        $temporario = $_FILES['foto']['tmp_name'];//Caminho temporário
                        $newname = uniqid().".$extensao";//Criar um novo nome e usar a msm extensão

                        if(move_uploaded_file($temporario, $pasta.$newname)){
                            
                        }else{
                            echo "Algo de errado não está certo";
                        }
                       }else{
                        echo "Formato inválido";
                       }
                    }else{
                        $newname = $fotoUs;
                    }
                    $update = "UPDATE tbusers SET nameUser=:nome,emailUser=:email,passUser=:pass,fotoUser=:foto WHERE idUser=:id";

                            try{
                                $result = $conect->prepare($update);
                                $result->bindParam(':id',$id, PDO::PARAM_INT);
                                $result->bindParam(':nome',$nome, PDO::PARAM_STR);
                                $result->bindParam(':email',$email, PDO::PARAM_STR);
                                $result->bindParam(':pass',$pass, PDO::PARAM_STR);
                                $result->bindParam(':foto',$newname, PDO::PARAM_STR);
                                $result->execute();

                                $contar=$result->rowCount();
                                    if($contar > 0){
                                        echo '<div class="container">
                                                    <div class="alert alert-success" role="alert">
                                                        OK Conta atualizada!
                                                    </div>
                                                </div>';
                                    }else{
                                        echo '<div class="container">
                                                    <div class="alert alert-danger" role="alert">
                                                        Ops Algo de errado!
                                                    </div>
                                                </div>';
                                    }


                            }catch (PDOExceptio $e){
                                echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
                            }

                            

                    }
                
                ?>
            </div>
            <div class="col-lg-4">
                <div class="card" style="align-items: center;">
                <img src="img/salvos/<?php echo $fotoUs; ?>" alt="<?php echo $fotoUs; ?>" style="width: 200px; border-radius: 100%;">
                <h1><?php echo $nomeUs; ?></h1>
                <strong><?php echo $emailUs; ?></strong>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>