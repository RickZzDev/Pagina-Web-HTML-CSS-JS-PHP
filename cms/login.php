<?php

session_start();
session_unset();
require_once('../bd/conexao.php');

$conexao = conexaoMySql();

$login = $_GET['inputLogin'];
$senha = $_GET['inputSenha'];
$senha_cript = md5($senha);

if(isset($_GET['btnLogar'])){
    $sql = "select * from tblusuario where login ='".$login."' and senha='".$senha_cript."'";

    $rodaScript = mysqli_query($conexao,$sql);

    if($array = mysqli_fetch_array($rodaScript)){
        $_SESSION['codigoLogin'] = $array['codigo'];
        header('location:admUsuarios.php');
    }else{
        echo("erro");
    }
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>
<body>
    <form method="GET" action="login.php" name="frmLogar">
        <div id="container_login">
            <div class="loginSenha">
                <input type="text" id="inputLogin" name="inputLogin" placeholder="Digite seu login">
            </div>
            <div class="loginSenha">
                <input type="text" id="inputSenha" name="inputSenha" placeholder="Digite sua senha">
            </div>
            <div id="containerBtn">
                <input type="submit" id="btnLogar" name="btnLogar" value="logar">
            </div>
        </div>
    </form>
</body>
</html>