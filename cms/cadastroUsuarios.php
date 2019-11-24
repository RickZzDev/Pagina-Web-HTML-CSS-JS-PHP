<?php

    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();

  
    if(isset($_GET['modo'])== 'atualizar'){
       
        $teste = $_GET['campo'];
        
        if(isset($_GET['campo']) == '2'){
            
            var_dump($_GET['campo']);
            echo("no dois");
            // $codigo = $_GET['codigo'];
         
            // $select = "select adm_fale_conosco from tblnivel where codigo=".$codigo;
         
            // $script = mysqli_query($conexao,$select);

            // $rsconsultas2 = mysqli_fetch_array($script);

            // if($rsconsultas2['adm_fale_conosco']==1){
            //     $update = "update tblnivel set adm_fale_conosco = 0 where codigo =".$codigo;
                
            //     mysqli_query($conexao,$update);
            //     header('location: cadastroUsuarios.php');
            // }elseif($rsconsultas2['adm_fale_conosco']==0){
                
            //     $update = "update tblnivel set adm_fale_conosco = 1 where codigo =".$codigo;

            //     mysqli_query($conexao,$update);
            //     header('location: cadastroUsuarios.php');
            // }

            // echo($rsconsultas2['adm_conteudo']);
        }

        if(isset($_GET['campo']) == '1'){
            echo("no 1");
            $codigo = $_GET['codigo'];
         
            $select = "select adm_conteudo from tblnivel where codigo=".$codigo;
         
            $script = mysqli_query($conexao,$select);

            $rsconsultas2 = mysqli_fetch_array($script);

            if($rsconsultas2['adm_conteudo']==1){
                $update = "update tblnivel set adm_conteudo = 0 where codigo =".$codigo;
                
                mysqli_query($conexao,$update);
                // header('location: cadastroUsuarios.php');
            }elseif($rsconsultas2['adm_conteudo']==0){
                
                $update = "update tblnivel set adm_conteudo = 1 where codigo =".$codigo;

                mysqli_query($conexao,$update);
                // header('location: cadastroUsuarios.php');
            }

            // echo($rsconsultas2['adm_conteudo']);
        }
    }

    if(isset($_GET['btnEnviar'])){
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
             header('location:cadastroUsuarios.php');
         }else{
             echo("erro ao enviar ao banco");
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
    <link rel="stylesheet" href="../css/styleContato.css">
    <link rel="stylesheet" href="../css/stykeCmsFale.css">

</head>
<body>
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
                            <div class="tipo_adm">Adm. Conteúdo</div>
                        </div>
                        <div class="caixa_usuarios">
                            <div class="img_adm">
                                <img src="../imagens/fale.png">
                            </div>
                            <div class="tipo_adm">Adm. Fale Conosco</div>
                        </div>
                        <div class="caixa_usuarios">
                            <div class="img_adm">
                                <img src="../imagens/usuario.png">
                            </div>
                            <div class="tipo_adm">Adm. Usuários</div>
                        </div>
                        <div id="area_bem_vindo">
                            Bem Vindo, [xxxxxxxxxxx]
                        </div>
                        
                        <div id="caixa_logout">
                            <input type="button" id="btnLogout" value="Logout">
                        </div>
                    </div>
    <div id="primeiraLinha">
        <div class="fixaCentro center">
            <div class="promocoesTitulo center">
                <h1>Cadastro de nivel</h1><hr>
            </div>
                <form name="frmContato" method="get" action="cadastroUsuarios.php">
                <div class="fixaCentro2 center">
                    <div class="camposFrm">
                        <div class="txtCampo">
                            *Nome:
                        </div>
                        <input type="text" id="txtNome" value="" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
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

                    <div id="tituloNiveis">
                            <div class="nomeNivel">
                                NOME
                            </div>
                            <div class="nomeNivel">
                                ADM Conteudo
                            </div>
                            <div class="nomeNivel">
                                ADM fale conosco
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
                        <div class="divDados">
                            <div class="nomeNivel">
                                <?php echo($rsconsultas['nome'])?>
                            </div>
                            <div class="admNome">
                                <a href="cadastroUsuarios.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=1"><img src="../imagens/<?= $rsconsultas['adm_conteudo']?>.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastroUsuarios.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=2"><img src="../imagens/<?=$rsconsultas['adm_fale_conosco']?>.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastroUsuarios.php?modo=atualizar&codigo=<?= $rsconsultas['codigo']?>&campo=3"><img src="../imagens/<?=$rsconsultas['adm_fale_conosco']?>.png"></a>
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