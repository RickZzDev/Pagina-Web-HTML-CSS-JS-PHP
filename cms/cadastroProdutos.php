<?php

    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');
    $conexao = conexaoMySql();
   
    session_start();


    
    $permicao = autenticar($_SESSION['codigoLogin']);

        
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $arrayUsuario = mysqli_fetch_array($rodaScript);


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
            if(isset($_SESSION['previewFoto'])){
                $foto = $_SESSION['previewFoto']; 
                echo('sim existe');
            }
            $nome = $_GET['txtNome'];
            echo "--".$nome;
            $descricao = $_GET['txtDescricao'];
            echo $descricao."---";
            $preco = $_GET['txtPreco'];
            echo $preco;
            $sltCategoria = $_GET['sltCategoria'];
            echo "ENTROOOOOOOOOU";
            $sql = "insert into tblprodutos (nome,descricao,preco,foto) values ('".$nome."','".$descricao."', '".$preco."','".$foto."')";
            echo $sql;
            $rodaScript = mysqli_query($conexao,$sql);
            echo 
            $selectMaior = "select * from tblprodutos order by id_produtos desc
            limit 1";

            $rodaScriptMaior = mysqli_query($conexao,$selectMaior);
            $arrayMaior = mysqli_fetch_array($rodaScriptMaior);
            $idUltimo = $arrayMaior['id_produtos'];

            echo ($arrayMaior['id_produtos']);
            for($i=0;$i<=$_SESSION['conta'];$i++){
                if($_GET[$i] != ''){
                    echo $_SESSION['conta'].
                }
            }
            session_unset();
            // header('location: cadastroProdutos.php');
        }
        
    }


    echo($_SESSION['modo']);

    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
     }

     $status = 'none';
     
     if(isset($_POST['btnCategoria'])){
         $status = 'visible';
         $_SESSION['codCategoria'] = $_POST['sltCategorias'];
         $codCategoria = $_SESSION['codCategoria'];
         $sql  = "select nome from tblcategoria where id_categoria =".$_SESSION['codCategoria'];
         $rodaScript = mysqli_query($conexao,$sql);
         $array = mysqli_fetch_array($rodaScript);
         
         $_SESSION['nomeCategoria'] = $array['nome'];
         
         $nomeCategoria = $_SESSION['nomeCategoria'];
         $_SESSION['click'] = 'clicou';
         $click = $_SESSION['click'];
         echo $click;
         echo $array['nome'];
  
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
    <script src="../Js/jquery.js"></script>
    <script src="../Js/jquery.form.js"></script>
    <script src="../Js/modulo.js"></script>
     <script>
     
             
     $(document).ready(function(){
                   
                    //Function para fazer o upload e o preview da imagem
                    $('#fileFoto').live('change',function(){
                        $('#formFoto').ajaxForm({
                            target:'#foto'//callback do upload.php
                        }).submit();
                    });                  
   
                });
     </script>
     <style>
         .camposFrm{
             display:<?=$status?>;
         }
     </style>
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
                             Bem Vindo, <?=$arrayUsuario['nome']?>
                        </div>
                        <form method="get" action="cadastroProdutos.php" name="frmBtn">
                            <div id="caixa_logout">
                                <input type="submit" id="btnLogout" name="btnLogout" value="Logout">
                            </div>
                        </form>
                    </div>
        <div id="primeiraLinha">
            <div class="fixaCentro center">
                <div class="promocoesTitulo center">
                    <h1>Cadastro de produtos</h1><hr>
                </div>
                    
                    <div class="fixaCentro2 center">
                        <div class="camposFrm2">                   
                        <form method="post" id="formCategorias" name="frmCategorias" aciton="cadastroProdutos.php" enctype="multipart/form-data">
                            <select name="sltCategorias" id="sltCategorias">
                                    
                                    <?php
                                    
                                        if($click == "clicou"){
                                            
                                            $sql = "select * from tblcategoria where id_categoria !=".$codCategoria;
                                            ?>
                                        
                                        <option><?=$nomeCategoria?></option>

                                        <?php }else{
                                            
                                            $sql = "select * from tblcategoria";
                                        } 

                                        ?>
                                        <option value=''>Esolha uma categoria</option>
                                       <?php 
                                        $rodaScript = mysqli_query($conexao,$sql);

                                        while($array = mysqli_fetch_array($rodaScript)){?>
                                            <option value='<?=$array['id_categoria']?>'><?=$array['nome']?></option>
                                        <?php }  ?> 
                                   
                            </select>
                            <input type="submit" name="btnCategoria" value="selecionar"></input>
                       
                        </form>
                        </div>
                        <div id="foto">
                            <img src="../bd/arquivos/<?=@$arrayConsulta['foto']?>"
                                height="130" width="140">
                        </div>
                        <form name="frmfoto" id="formFoto" method="post" action="../bd/upload.php" enctype="multipart/form-data">
                            <div class="fixaCentro2 center">
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        <h2>Foto: </h2>
                                </div>
                                <input type="file" name="flefoto" accept="" id="fileFoto">
                            </div>
                        </form>
                    <form name="frmContato" method="get" action="cadastroProdutos.php"> 
                        
                            <div class="camposFrm">
                                <div class="txtCampo">
                                    *Nome:
                                </div>
                                <input type="text" name="txtNome" id="txtNome" value="<?= @$array['nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                            </div>
                            <div class="camposFrm">
                                <div class="txtCampo">
                                    Descrição:
                                </div>
                                <input type="text" name="txtDescricao" id="txtDescricao" value="<?= @$array['nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                            </div>
                            <div class="camposFrm">
                                <div class="txtCampo">
                                    Preço:
                                </div>
                                <input type="text" name="txtPreco" id="txtPreco" value="<?= @$array['nome']?>" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                            </div>
                            <?php
                                $sql = "select * from tblcategoria inner join tblsubcategoria
                                        on tblcategoria.id_categoria = tblsubcategoria.id_categoria 
                                        where tblcategoria.id_categoria =".$codCategoria;
                                       
                                $rodaScript = mysqli_query($conexao,$sql);
                                $cont = 0;          
                                while($arrayChk = mysqli_fetch_array(($rodaScript))){
                                     ?>
                                    <div class="camposFrm">
                                        <div class="txtCampo">
                                            <?=$arrayChk['nome'].$cont?>
                                        </div>
                                        <input type="checkbox" name="<?=$cont?>" value="<?=$arrayChk['id_subcategoria']?>">
                                    </div>
                               <?php $cont++;} $_SESSION['conta'] = $cont ?>
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
                                    $sql = "select * from tblprodutos";

                                    $rodaScript = mysqli_query($conexao,$sql);

                                    while($rsconsultas = mysqli_fetch_array($rodaScript)){
                            ?>
                                <div class="divDados">
                                    <div class="admNome">
                                        <?php echo($rsconsultas['nome'])?>
                                    </div>
        
                                    <div class="admNome">
                                        <a href="cadastroSubCategoria.php?modo=editar&codigo=<?= $rsconsultas['id_produto']?>"><img src="../imagens/editar.png"></a>
                                    </div>
                                    <div class="admNome">
                                        <a href="cadastroSubCategoria.php?modo=mudar&codigo=<?= $rsconsultas['id_codigo']?>&status=<?=$rsconsultas['status']?>"><img src="../imagens/<?=$rsconsultas['status']?>.png"></a>
                                    </div>
                                    <div class="admNome">
                                        <a href="cadastroSubCategoria.php?modo=excluir&codigo=<?= $rsconsultas['id_produto']?>"><img src="../imagens/excluir.png"></a>
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
