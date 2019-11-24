<?php
   
   session_start();
    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');
    $conexao = conexaoMySql();
    
    if(isset($_SESSION['codigoLogin'])){
        echo 'existe';
    }else{
        echo 'nao existe';
    }

    $permicao = autenticar($_SESSION['codigoLogin']);
    
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);

    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
     }
    
?>

<html>
    <head>
        <title>
            Formulario
        </title>
        <link rel="stylesheet" type="text/css" href="../css/stykeCmsFale.css">
        <link rel="stylesheet" type="text/css" href="../css/styleContato.css">

    </head>
    
    <body>
        <main id="container_geral" class="center">
            <!--Area do titulo e da imagem dos amds -->
            <div id="area_titulo">
                <div id="titulo_cms">
                    <h1>CMS-Sistema de gerenciamento do site</h1>
                </div>
                <div id="img_cms"></div>
            </div>
            <!--Area dos icones dos adms -->
            <div id="area_adms">
                <div class="caixa_usuarios">
                    <div class="img_adm ">
                        <img src="../imagens/conteudo.png">
                    </div>
                    <div class="tipo_adm"><a class="link" href="<?=$permicao[0]?>">Adm. Conteúdo</a></div>
                </div>
                <div class="caixa_usuarios">
                    <div class="img_adm">
                        <img src="../imagens/fale.png">
                    </div>
                    <div class="tipo_adm"><a class="link"  href="<?=$permicao[1]?>">Adm. Fale Conosco</a></div>
                </div>
                <div class="caixa_usuarios">
                    <div class="img_adm">
                        <img src="../imagens/usuario.png">
                    </div>
                    <div class="tipo_adm"><a class="link"  href="<?=$permicao[2]?>">Adm. Usuários</a></div>
                </div>
                <div id="area_bem_vindo">
                    Bem Vindo, <?=$array['nome']?>
                </div>
                <form method="get" action="admUsuarios.php" name="frmBtn">
                    <div id="caixa_logout">
                        <input type="submit" id="btnLogout" name="btnLogout" value="Logout">
                    </div>
                </form>
            </div>
            
            
            <!-- Paginas para serem modificadas -->
            
            <div id="area_paginas">
                <div id="escolha">
                    <div class="escolhaPagina">
                        <img src="../imagens/nivel.png" />
                        <div class="nomePagina"><a class="link"  href="cadastrousuario.php">Administração de usuario</a></div>
                    </div>
                    <div class="escolhaPagina">
                        <img src="../imagens/user.png" />   
                        <div class="nomePagina"><a class="link"  href="cadastroNivel.php"> Administração de nível</a></div>
                    </div>
                </div>
            </div>
                      
       
            <!-- Area do rodapé-->
            <footer id="rodape">
            
            </footer>
        </main>
    </body>
</html>