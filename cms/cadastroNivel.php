<?php

    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');
    session_start();

    $conexao = conexaoMySql();

    if(isset($_SESSION['codigoLogin'])){
        echo 'existe';
    }else{
        echo 'nao existe';
    }

    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);

    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
     }

    $permicao = autenticar($_SESSION['codigoLogin']);
   
    $modo = $_GET['modo'];
    $teste = (String) 'visible';
    
    if($modo == 'excluir'){
        echo("entrou excluir");
        $sql = "delete from tblnivel where codigo =".$_GET['codigo'];
        echo $sql;
        $sql2 = "select * from tblusuario where codinivel =".$_GET['codigo'];
        echo '--'.$sql2;
        mysqli_query($conexao,$sql);
        $selecionaUsuario = mysqli_query($conexao,$sql2);

        $array = mysqli_fetch_array($selecionaUsuario);
        
        $apagaUsuario = "delete from tblusuario where codigo=".$array['codigo'];
        echo $apagaUsuario;
        mysqli_query($conexao,$apagaUsuario);
    }elseif($modo == 'editar'){
       
        $_SESSION['modo'] = $modo;
        echo($_SESSION['modo'].'//');
        $_SESSION['codigo'] = $_GET['codigo'];
        $invisibleDiv = 'none';
        $sql = "select nome from tblnivel where codigo =".$_GET['codigo'];

        $script = mysqli_query($conexao,$sql);

        $rsConsultaEditar = mysqli_fetch_array($script);
    }

  
    if(isset($_GET['modo'])== 'atualizar'){
       
        $campo = intval($_GET['campo']);
        var_dump($campo);


       if($campo == 2){
            
            
            echo("no dois");
            $codigo = $_GET['codigo'];
           
            
         
            $select = "select adm_fale_conosco from tblnivel where codigo=".$codigo;
         
            $script = mysqli_query($conexao,$select);

            $rsconsultas2 = mysqli_fetch_array($script);

            if($rsconsultas2['adm_fale_conosco']==1){
                $update = "update tblnivel set adm_fale_conosco = 0 where codigo =".$codigo;
                
                mysqli_query($conexao,$update);
                header('location: cadastroNivel.php');
            }elseif($rsconsultas2['adm_fale_conosco']==0){
                
                $update = "update tblnivel set adm_fale_conosco = 1 where codigo =".$codigo;

                mysqli_query($conexao,$update);
                header('location: cadastroNivel.php');
            }

            // echo($rsconsultas2['adm_conteudo']);
        }

        elseif($campo == 1){
            echo("no 1");
            $codigo = $_GET['codigo'];
         
            $select = "select adm_conteudo from tblnivel where codigo=".$codigo;
         
            $script = mysqli_query($conexao,$select);

            $rsconsultas2 = mysqli_fetch_array($script);

            if($rsconsultas2['adm_conteudo']==1){
                $update = "update tblnivel set adm_conteudo = 0 where codigo =".$codigo;
                
                mysqli_query($conexao,$update);
                header('location: cadastroNivel.php');
            }elseif($rsconsultas2['adm_conteudo']==0){
                
                $update = "update tblnivel set adm_conteudo = 1 where codigo =".$codigo;

                mysqli_query($conexao,$update);
                header('location: cadastroNivel.php');
            }

            // echo($rsconsultas2['adm_conteudo']);
        }elseif($campo==3){
            echo("no tres");
            $codigo = $_GET['codigo'];
         
            $select = "select adm_usuario from tblnivel where codigo=".$codigo;
            
         
            $script = mysqli_query($conexao,$select);

            $rsconsultas3 = mysqli_fetch_array($script);
            
            if($rsconsultas3['adm_usuario']==1){
                $update = "update tblnivel set adm_usuario = 0 where codigo =".$codigo;
                
                mysqli_query($conexao,$update);
                echo($update);
                header('location: cadastroNivel.php');
            }elseif($rsconsultas3['adm_usuario']==0){
                
                $update = "update tblnivel set adm_usuario = 1 where codigo =".$codigo;

                mysqli_query($conexao,$update);
                header('location: cadastroNivel.php');
            }
        }
    }

    if(isset($_GET['btnEnviar'])){
        echo("fora de tudo\n");
        echo('--'.$_SESSION['modo'].'--');
        if($_SESSION['modo'] == 'editar'){
            echo('entrou no editar');
            echo($_SESSION['modo']);
            $sql = "update tblnivel set nome = '".$_GET['txtNome']."'  where codigo =".$_SESSION['codigo'];
            echo("--".$_SESSION['codigo']."-----");
            echo($sql);
            mysqli_query($conexao,$sql);
            unset($_SESSION['modo']);
            header('location: cadastroNivel.php');
        }else{
            echo('teste');
            echo("modo".$_SESSION['modo']);
            $nome = $_GET['txtNome'];
            $chkConteudo = intval($_GET['chkConteudo']);
           @$chkFale = intval($_GET['chkFale']);
           @$chkUsuario = intval($_GET['chkUsuarios']);
   
            var_dump($chkConteudo);
            var_dump($chkFale);
            var_dump($chkUsuario);
   
            $sql = "insert into tblnivel(nome,adm_conteudo,adm_fale_conosco,adm_usuario) values ('".$nome."',".$chkConteudo.",
            ".$chkFale.", ".$chkUsuario.")";
   
            if(mysqli_query($conexao,$sql)){
                header('location:cadastroNivel.php');
            }else{
                echo("erro ao enviar ao banco");
            }
   
            echo($sql);
        }
    }

//    session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleContato.css">
    <link rel="stylesheet" href="../css/stykeCmsFale.css">

    <style>
        .camposFrm{
            display: <?= $invisibleDiv?>;
            

        }
    </style>

</head>
<body>
        <div id="teste"></div>
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
                            <div class="tipo_adm"><a class="link" href="<?=$permicao[1]?>">Adm. Fale Conosco</a></div>
                        </div>
                        <div class="caixa_usuarios">
                            <div class="img_adm">
                                <img src="../imagens/usuario.png">
                            </div>
                            <div class="tipo_adm"><a class="link" href="<?=$permicao[2]?>">Adm. Usuários</a></div>
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
    <div id="primeiraLinha">
        <div class="fixaCentro center">
            <div class="promocoesTitulo center">
                <h1>Cadastro de nivel</h1><hr>
            </div>
                <form name="frmContato" method="get" action="cadastroNivel.php">
                <div class="fixaCentro2 center">
                    <div id="campoNome">
                        <div class="txtCampo">
                            *Nome:
                        </div>
                        <input type="text" id="txtNome"  value="<?=@$rsConsultaEditar['nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                    </div>
                    <div class="camposFrm">
                        <div class="txtCampo">
                            adm conteudo
                        </div>
                        <input type="checkbox" name="chkConteudo" value="1">
                    </div>


                    <div class="camposFrm">
                        <div class="txtCampo">
                            adm fale conosco
                        </div>
                        <input type="checkbox" name="chkFale" value="1">
                    </div>
                    <div class="camposFrm">
                        <div class="txtCampo">
                            adm usuarios
                        </div>
                        <input type="checkbox" name="chkUsuarios" value="1">
                    </div>
                    <div id="btnEnviar_div">
                        <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                      
                    </div>

                    <div class="tituloNiveis">
                            <h1>Niveis cadastrados</h1>
                    </div>

                    <div class="tituloNiveis2">
                            <div class="nomeNivel">
                                Nome
                            </div>
                            <div class="nomeNivel">
                                Adm conteudo
                            </div>
                            <div class="nomeNivel">
                                Adm fale conosco
                            </div>
                            <div class="nomeNivel">
                                Adm usuarios
                            </div>
                    </div>
                    <?php
                            $sql = "select * from tblnivel";

                            $rodaScript = mysqli_query($conexao,$sql);

                            while($rsconsultas = mysqli_fetch_array($rodaScript)){
                    ?>
                        <div class="divDados2">
                            <div class="admNome2">
                                <?php echo($rsconsultas['nome'])?>
                            </div>
                            <div class="admNome2">
                                <a href="cadastroNivel.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=1"><img src="../imagens/<?= $rsconsultas['adm_conteudo']?>.png"></a>
                            </div>
                            <div class="admNome2">
                                <a href="cadastroNivel.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=2"><img src="../imagens/<?=$rsconsultas['adm_fale_conosco']?>.png"></a>
                            </div>
                            <div class="admNome2">
                                <a href="cadastroNivel.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=3"><img src="../imagens/<?=$rsconsultas['adm_usuario']?>.png"></a>
                            </div>
                            <div class="admNome2">
                                <a href="cadastroNivel.php?modo=excluir&codigo=<?= $rsconsultas['codigo']?>"><img src="../imagens/excluir.png"></a>
                                <a href="cadastroNivel.php?modo=editar&codigo=<?= $rsconsultas['codigo']?>"><img src="../imagens/editar.png"></a>

                            </div>
                        </div>
                    <?php 
                            };
                    ?>
                </div>   
            </form>    
        </div>
    </div>
</body>
</html>