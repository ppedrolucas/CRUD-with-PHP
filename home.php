<?php
ob_start(); //ARMAZENA MEUS DADOS EM CACHE
session_start(); //INICIA A SESSÃO
if(!isset($_SESSION['loginUser']) && (!isset($_SESSION['passUser']))){
    header("Location: index.php?acao=negado");
    exit;
}
include_once('sair.php')
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
        <div class="row">
            <a href="?sair">Sair do sistema</a>
            <div class="col-lg-4">
            <form action="" method="post" enctype="multipart/form-data">
                    <h2>Formulário</h2>
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" name="nome" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="pass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Foto:</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <hr>
                    <button type="submit" name="btnE" class="btn btn-primary">Enviar</button>
                </form>
                <?php
                
                    include_once('config/conexao.php');  
                    if(isset($_POST['btnE'])) {
                        $nome=$_POST['nome'];
                        $email=$_POST['email'];
                        $pass=$_POST['pass'];
                       // $foto=$_FILES['foto'];
                       $formaP = array("png","jpg","JPG","jpeg","gif",);//Formatos permitidos
                       $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);//Extrair a extensão

                       if(in_array($extensao, $formaP)){
                        $pasta = "img/salvos/";//Salvar em uma pasta
                        $temporario = $_FILES['foto']['tmp_name'];//Caminho temporário
                        $newname = uniqid().".$extensao";//Criar um novo nome e usar a msm extensão

                        if(move_uploaded_file($temporario, $pasta.$newname)){
                            $cadastrar = "INSERT INTO tbusers (nameUser,emailUser,passUser,fotoUser) VALUES (:nome,:email,:pass,:foto)";

                            try{
                                $result = $conect->prepare($cadastrar);
                                $result->bindParam(':nome',$nome, PDO::PARAM_STR);
                                $result->bindParam(':email',$email, PDO::PARAM_STR);
                                $result->bindParam(':pass',$pass, PDO::PARAM_STR);
                                $result->bindParam(':foto',$newname, PDO::PARAM_STR);
                                $result->execute();

                                $contar=$result->rowCount();
                                    if($contar > 0){
                                        echo '<div class="container">
                                                    <div class="alert alert-success" role="alert">
                                                        OK Cadastro realizado com Sucesso!
                                                    </div>
                                                </div>';
                                    }else{
                                        echo '<div class="container">
                                                    <div class="alert alert-danger" role="alert">
                                                        OK Cadastro realizado com Sucesso!
                                                    </div>
                                                </div>';
                                    }


                            }catch (PDOExceptio $e){
                                echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
                            }
                        }else{
                            echo "Algo de errado não está certo";
                        }
                       }else{
                        echo "Formato inválido";
                       }


                    }
                
                ?>
            </div>
            <div class="col-lg">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $select = "SELECT * FROM tbusers ORDER BY idUser DESC LIMIT 5";
                            try{
                                $result = $conect->prepare($select);
                                $cont = 1;
                                $result->execute();

                                $contar = $result->rowCount();
                                    if($contar > 0){
                                        while($show = $result->FETCH(PDO::FETCH_OBJ)){

                                        
                        ?>

                        <tr>
                            <th scope="row"><?php echo $show->idUser;?></th>
                            <td><?php echo $show-> nameUser;?></td>
                            <td><?php echo $show-> emailUser;?></td>
                            <td><?php echo $show-> passUser;?></td>
                            <td><img class="" src="img/salvos/<?php echo $show-> fotoUser; ?>" alt="" style="height: 100%; width: 50px; border-radius: 50%"></td>
                            <td class="d-flex">
                                <a href="update.php?id=<?php echo $show->idUser;?>" class="btn btn-success">Up</a>
                                <a href="del.php?idDel=<?php echo $show->idUser;?>" class="btn btn-danger" title="Remover">Dn</a>
                            </td>
                        </tr>

                        <?php
                                            }
                                        }else{

                                        }
                                }catch (PDOException $e){
                                    echo "<strong>ERRO DE PDO = </strong>".$e->getMessage();
                                }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</body>
</html>