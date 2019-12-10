<?php

    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');
    $conexao = conexaoMySql();
   
    session_start();


    
    $permicao = autenticar($_SESSION['codigoLogin']);

        
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);


    if($_GET['modo'] == 'editar'){

        $_SESSION['modo'] = $_GET['modo'];
        $modo = $_SESSION['modo'];
        $_SESSION['codigo'] = $_GET['codigo'];

       $sql = "select * from tblsubcategoria where id_subcategoria =".$_GET['codigo'];
    
       $rodaScript = mysqli_query($conexao,$sql);

       $array = mysqli_fetch_array($rodaScript);
        echo $array['id_categoria'];

        $sqlCategoria = "select * from tblcategoria where id_categoria =".$array['id_categoria'];
        
        $pegaIdCategoria = mysqli_query($conexao,$sqlCategoria);
        $arrayCategoria = mysqli_fetch_array($pegaIdCategoria);
        echo  '=='.$arrayCategoria['nome']."---";
       echo $array['nome'];
    }

    if($_GET['modo']== 'excluir'){
        session_unset();
        $sql = "delete from tblsubcategoria where id_subcategoria =".$_GET['codigo'];

        $rodaScript = mysqli_query($conexao,$sql);
    }


    echo '..antes';
    if(isset($_GET['btnEnviar'])){
        echo 'entrou';
        if(isset($_SESSION['modo']) == 'editar'){
            $sql = "update tblsubcategoria set nome = '".$_GET['txtNome']."', id_categoria = '".$_GET['sltCategoria']."'
             where id_subcategoria =".$_SESSION['codigo'];
            echo $sql;
            $rodaScript = mysqli_query($conexao,$sql);
            session_unset();
            echo 'entrou editar';

            // header('location: cadastroSubCategoria.php');
        }
        else{
            
            $nome = $_GET['txtNome'];
            $sltCategoria = $_GET['sltCategoria'];
            $sql = "insert into tblsubcategoria (nome,id_categoria) values ('".$nome."','".$sltCategoria."')";
            $rodaScript = mysqli_query($conexao,$sql);
            session_unset();
            // header('location: cadastroSubCategoria.php');
        }


    }


    echo($_SESSION['modo']);

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
                        <form method="get" action="cadastroCategoria.php" name="frmBtn">
                            <div id="caixa_logout">
                                <input type="submit" id="btnLogout" name="btnLogout" value="Logout">
                            </div>
                        </form>
                    </div>
    <div id="primeiraLinha">
        <div class="fixaCentro center">
            <div class="promocoesTitulo center">
                <h1>Cadastro de subacategoria</h1><hr>
            </div>
                <form name="frmContato" method="get" action="cadastroSubCategoria.php">
                <div class="fixaCentro2 center">
                    <div class="camposFrm">
                        <div class="txtCampo">
                            *Nome:
                        </div>
                        <input type="text" id="txtNome" value="<?= @$array['nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                    </div>
                    <div class="camposFrm">
                        <div class="txtCampo">
                            Categoria
                        </div>
                        <select name="sltCategoria">
                            <?php

                                

                                if($modo == 'editar'){
                                    $sql = "select * from tblcategoria where nome != '".$arrayCategoria['nome']."' ";
                                    echo $sql;
                                    $rodaScript = mysqli_query($conexao,$sql);
                                     ?>
                                    <option value="<?=$arrayCategoria['id_categoria']?>"> <?=$arrayCategoria['nome']?> </option>
                            <?php }
                            else {
                                $sql = "select * from tblcategoria";

                                $rodaScript = mysqli_query($conexao,$sql);
                                ?>
                                    <option> Escolha uma opção </option>

                            <?php }
                            


                            while($rsconsultas = mysqli_fetch_array($rodaScript)){?>
                        
                            
                            
                        

                        
                            <option value="<?=$rsconsultas['id_categoria']?>"><?=$rsconsultas['nome']?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div id="btnEnviar_div">
                        <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                      
                    </div>
                    <div class="tituloNiveis">
                            <h1>Categorias cadastradas</h1>
                    </div>

                    <div class="tituloNiveis">
                            <div class="nomeNivel">
                                Nome
                            </div>
                    </div>
                    <?php
                            $sql = "select * from tblsubcategoria";

                            $rodaScript = mysqli_query($conexao,$sql);

                            while($rsconsultas = mysqli_fetch_array($rodaScript)){
                    ?>
                        <div class="divDados">
                            <div class="admNome">
                                <?php echo($rsconsultas['nome'])?>
                            </div>
 
                            <div class="admNome">
                                <a href="cadastroSubCategoria.php?modo=editar&codigo=<?= $rsconsultas['id_subcategoria']?>"><img src="../imagens/editar.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastroSubCategoria.php?modo=mudar&codigo=<?= $rsconsultas['id_codigo']?>&status=<?=$rsconsultas['status']?>"><img src="../imagens/<?=$rsconsultas['status']?>.png"></a>
                            </div>
                            <div class="admNome">
                                <a href="cadastroSubCategoria.php?modo=excluir&codigo=<?= $rsconsultas['id_subcategoria']?>"><img src="../imagens/excluir.png"></a>
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
