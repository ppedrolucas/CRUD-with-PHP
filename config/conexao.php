<?php

    try{
        DEFINE('HOST','localhost');
        DEFINE('BD','bdawp');
        DEFINE('USER','root');
        DEFINE('PASS','');

        $conect = new PDO('mysql:host='.HOST.';dbname='.BD,USER,PASS); //Criar Variável//
        $conect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Utilizar Variável//
    }catch(PDOException $e){
        echo "<strong>ERRO DE PDO</strong>".$e->getMessage();   
    }

    
    