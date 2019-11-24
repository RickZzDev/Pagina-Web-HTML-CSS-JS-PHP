<?php

    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');
    $conexao = conexaoMySql();
   
    session_start();


    if(@$_GET['modo'] == 'mudar'){
        if($_GET['status'] == 0){
           
           
                $updateStatus = "update tblusuario set status = 1 where codigo =".$_GET['codigo'];

                mysqli_query($conexao,$updateStatus);
                
            //    header('location: cadastrousuario.php');
            
        }else{
            echo('entrou aqui');
            $updateStatus = "update tblusuario set status = 0 where codigo =".$_GET['codigo'];

            mysqli_query($conexao,$updateStatus);

            // header('location: cadastrousuario.php');
        }

    }

    if(isset($_SESSION['codigoLogin'])){
        echo 'existe';
    }else{
        echo 'nao existe';
    }

    $permicao = autenticar($_SESSION['codigoLogin']);

        
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);

    $modo = $_GET['modo'];
    if($modo == 'excluir'){
        echo("entrou excluir");
        $sql = "delete from tblusuario where codigo =".$_GET['codigo'];

        mysqli_query($conexao,$sql);
    }elseif($modo=='editar'){
       
        $sql = "select tblusuario.*,
         tblusuario.nome  as id_nome,tblusuario.codigo as id_codigo,tblnivel.* from tblusuario inner join tblnivel on tblusuario.codigo =".$_GET['codigo'];
        echo($sql);
        $script = mysqli_query($conexao,$sql);

        $rsConsultaEditar = mysqli_fetch_array($script);

        $_SESSION['editar'] = (String) 'editar';
        $_SESSION['codigo'] = (Int) $rsConsultaEditar['id_codigo'];

    }

    if(isset($_GET['btnEnviar'])){

        if(isset($_SESSION['editar'])){
            echo('update');
            $sql = "update tblusuario  set nome = '".$_GET['txtNome']."', login = '".$_GET['txtLogin']."',
            senha = 
            '".$_GET['txtSenha']."' where codigo =
            ".$_SESSION['codigo'];
            
            mysqli_query($conexao,$sql);
            unset($_SESSION['editar']);
            echo($sql);

        }else{
            echo('inserir');
            $nome = $_GET['txtNome'];
            $login = $_GET['txtLogin'];
            $senha = $_GET['txtSenha'];
            $senha_cript = md5($senha); 
            $nivel = $_GET['sltNivel'];
            $sql= "insert into tblusuario(nome,login,senha,codinivel,status) values ('".$nome."','".$login."','".$senha_cript."','".$nivel."','1')";
    
            echo($sql);
            mysqli_query($conexao,$sql);
            session_unset();
            header('location: cadastrousuario.php');
        }

    }

    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);

    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
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
                <h1>Cadastro de usuario</h1><hr>
            </div>
                <form name="frmContato" method="get" action="cadastrousuario.php">
                <div class="fixaCentro2 center">
                    <div class="camposFrm">
                        <div class="txtCampo">
                            *Nome:
                        </div>
                        <input type="text" id="txtNome" value="<?= @$rsConsultaEditar['id_nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                    </div>
                    <div class="camposFrm">
                        <div class="txtCampo">
                            Login:
                        </div>
                        <input type="text"  maxlength="45" id="txtNome" name="txtLogin" value="<?= @$rsConsultaEditar['login']?>" placeholder="Login">
                    </div>


                    <div class="camposFrm">
                        <div class="txtCampo">
                           Senha
                        </div>
                        <input type="text" maxlength="45" id="txtNome" name="txtSenha" value="<?= @$rsConsultaEditar['senha']?>" placeholder="senha" >
                    </div>
                    <div class="camposFrm">
                        <div class="txtCampo">
                           Nivell:
                        </div>
                    <select name="sltNivel">
  
                        <?php
                          if($modo == 'editar'){
                            
                            ?> <option value="teste"><?=$rsConsultaEditar['nome']?></option>
                            
                            <?php
                                $sql = "select * from tblnivel where nome !='".$rsConsultaEditar['nome']."'";

                                $script = mysqli_query($conexao,$sql);

                                while($rsConsulta = mysqli_fetch_array($script)){
                            ?>

                                <option value="<?=$rsConsulta['codigo']?>"> <?= $rsConsulta['nome'];?> </option>

                                <?php }?>

                         <?php } else{  ?>
                                    <option value="teste">Escolha um dos niveis</option>
                            
                            <?php
                            $sql = "select * from tblnivel";

                            $script = mysqli_query($conexao,$sql);
                            
                            $rsConsultaEditar['nome'];
                            while($rsConsulta = mysqli_fetch_array($script)){
                            ?>
                                
                                <option value="<?=$rsConsulta['codigo']?>"> <?= $rsConsulta['nome'];?> </option>
                            <?php }; } ?>   
                        
                    </select>
                    </div>
    

                    <div id="btnEnviar_div">
                        <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                      
                    </div>
                    <div class="tituloNiveis">
                            <h1>Usuarios cadastrados</h1>
                    </div>

                    <div class="tituloNiveis">
                            <div class="nomeNivel">
                                Nome
                            </div>
                            <div class="nomeNivel">
                                Login
                            </div>

                            <div class="nomeNivel">
                                Nivel
                            </div>
                    </div>
                    <?php
                            $sql = "select tblusuario.*,
                            tblusuario.nome  as id_nome,tblusuario.codigo as id_codigo,tblnivel.* from tblusuario inner join tblnivel on tblusuario.codinivel = tblnivel.codigo";

                            $rodaScript = mysqli_query($conexao,$sql);

                            while($rsconsultas = mysqli_fetch_array($rodaScript)){
                    ?>
                        <div class="divDados">
                            <div class="admNome">
                                <?php echo($rsconsultas['id_nome'])?>
                            </div>
                            <div class="admNome">
                                <?php echo($rsconsultas['login'])?>
                            </div>

                            <div class="admNome">
                                 <?php echo($rsconsultas['nome'])?> 
                            </div>
                            <div class="admNome">
                                <a href="cadastrousuario.php?modo=editar&codigo=<?= $rsconsultas['id_codigo']?>"><img src="../imagens/editar.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastrousuario.php?modo=mudar&codigo=<?= $rsconsultas['id_codigo']?>&status=<?=$rsconsultas['status']?>"><img src="../imagens/<?=$rsconsultas['status']?>.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastrousuario.php?modo=excluir&codigo=<?= $rsconsultas['id_codigo']?>"><img src="../imagens/excluir.png"></a>
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