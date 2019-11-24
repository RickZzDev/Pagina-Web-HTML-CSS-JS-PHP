<?php 

    
    function conexaoMySql(){
        $host = (String) "localhost:8080";//onde esta o banco
        $user = (String) "root";//usuario para entrar no banco 
        $password = (String) "";//senha para entrar no banco
        $database = (String) "dbcontatos20192tb";//nome do banco
        
        $conexao = mysqli_connect($host,$user,$password,$database);
        return $conexao;
    }
    
?>