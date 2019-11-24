<?php

    require_once('../bd/auth.php');
    require_once('../bd/conexao.php');

    $conexao = conexaoMySql();
   
    session_start();
    
    $sql2="select * from tblcuriosidades";

    $rodaScript2 = mysqli_query($conexao,$sql2);
/******************************** */
    $permicao = autenticar($_SESSION['codigoLogin']);
    
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);
/******************** */
    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
     }

    if(@$_GET['modo'] =='editar'){
        $sql = 'select *  from tblcuriosidades where codigo ='.$_GET['codigo'];
        echo($sql);
   
        $rodaScript = mysqli_query($conexao,$sql);

        $arrayConsulta = mysqli_fetch_array($rodaScript);
       
        $_SESSION['modo'] = 'editar';
        $_SESSION['codigo'] = $_GET['codigo'];

        
    }


    if(@$_GET['modo'] == 'mudar'){
        if($_GET['status'] == 0){
            $confereStatus = "select * from tblcuriosidades where status = 1";

            $rodaConfere  = mysqli_query($conexao,$confereStatus);
            if(mysqli_num_rows($rodaConfere) >=3 ){
                echo('<script>alert("só é permitido ativar tres curiosidades e tres  fotos")  </script>');
            }else{
                $updateStatus = "update tblcuriosidades set status = 1 where codigo =".$_GET['codigo'];

                mysqli_query($conexao,$updateStatus);
                
                header('location: admCuriosidades.php');
            }
        }else{
            echo('entrou aqui');
            $updateStatus = "update tblcuriosidades set status = 0 where codigo =".$_GET['codigo'];

            mysqli_query($conexao,$updateStatus);

            header('location: admCuriosidades.php');
        }

    }


 if(@$_GET['modo'] =='excluir'){
     $sql = 'delete from tblcuriosidades where codigo ='.$_GET['codigo'];
     echo($sql);

     mysqli_query($conexao,$sql);
     header('location: admCuriosidades.php');
 }

 var_dump($_FILES['flefoto']);

  if(isset($_POST['btnEnviar'])){








   



    // if ($_FILES['flefoto']['size'] > 0 && $_FILES['flefoto']['type'] != "")
    // {
    //     echo("entrou auqi");
    //     //Guarda o tamanho do arquivo a ser upado para o servidor
    //     $arquivo_size = $_FILES['flefoto']['size'];

    //     //Converte o tamanho do arquivo para Kbyte e pega somente a parte inteira da conversão (round)
    //     $tamanho_arquivo = round($arquivo_size/1024);

    //     $arquivos_permitidos = array("image/jpeg", "image/jpg", "image/png");

    //     //Guarda o tipo de extenção do arquivo a ser upado para o servidor
    //     $ext_arquivo = $_FILES['flefoto']['type'];


    //     //Valida o tipo de arquivo a ser upado para o servidor
    //     if(in_array($ext_arquivo, $arquivos_permitidos))
    //     {

    //         //Valida o tamanho maximo de arquivo que esta sendo upado
    //         if($tamanho_arquivo < 1000)
    //         {

    //             //Permite retornar apenas o nome do arquivo 
    //             //pathinfo(var, PATHINFO_FILENAME)
    //             $nome_arquivo = pathinfo($_FILES['flefoto']['name'], PATHINFO_FILENAME);

    //             //Permite retornar apenas a extensão do arquivo
    //             //pathinfo(var, PATHINFO_FILENAME)
    //             $ext = pathinfo($_FILES['flefoto']['name'], PATHINFO_EXTENSION);

    //             //No PHP podemos usar dois algoritmos de criptografia (MD5, SHA1, hash(tipo do algoritmo, var))

    //             //Estamos gerando uma chave com o nome do arquivo + uniqid(time()) que é um numero aleatorio com base em uma hh:mm:ss
    //             $nome_arquivo_cripty = md5(uniqid(time()).$nome_arquivo);

    //             $foto = $nome_arquivo_cripty.".".$ext;

    //             $arquivo_temp = $_FILES['flefoto']['tmp_name'];

    //             $diretorio = "../bd/arquivos/";

    //             if (move_uploaded_file($arquivo_temp, $diretorio.$foto))
    //             {
    //                 $_SESSION['previewFoto'] = $foto;
    //                 echo("<img src='../bd/arquivos/".$foto."'>");
    //             } else{
    //                 echo("<script> 
    //                         alert('Não foi possivel enviar o arquivo para o servidor');
    //                     </script>");
    //             }


    //         }else{
    //             echo("<script> 
    //                     alert('Tamanho do arquivo não pode ser maior do que 2Mb');
    //                 </script>");
    //         }
    //     }else{
    //         echo("<script> 
    //                 alert('Tipo de arquivo não pode ser upado para o servidor (arquivos permitidos: .jpg, .png, .jpeg)');
    //             </script>");
    //     }
    // }else{
    //     echo("<script> 
    //             alert('Arquivo não selecionado conforme tamanho ou tipo de arquivo');
    //         </script>");
    // }












    

    // $confere = "select status from tblcuriosidades where status = 1";

    // $scriptConfere = mysqli_query($conexao,$confere);
 
    //   if(mysqli_num_rows($scriptConfere)>=0){
    //     echo("menos");
    // }else{
    //     echo('mais');
    // }
    $curiosidade1 = $_POST['txtArea1'];

        //tratamento para verificar se o usuario realmente fez o upload de um arquivo
        if(isset($_SESSION['previewFoto']))
            $foto = $_SESSION['previewFoto']; 
        else
                $foto = null;

    if(isset($_SESSION['modo']) == 'editar' )
    {
    
        $sql = "update tblcuriosidades set curiosidade ='".$curiosidade1."', foto = '".$foto."' where codigo =".$_SESSION['codigo'];
        mysqli_query($conexao,$sql);
        echo($sql);
        unset($_SESSION['modo']);
        header('location: admCuriosidades.php');
    }else{
        $confereStatus = "select * from tblcuriosidades where status = 1";

        $rodaConfere  = mysqli_query($conexao,$confereStatus);



      
        if(mysqli_num_rows($rodaConfere) >=3 ){

            $sql = "insert into tblcuriosidades (foto,curiosidade,status) values ('".$foto."','".$curiosidade1."','0')";

            $rodaScript = mysqli_query($conexao,$sql);
      
      
            $rsConsulta = mysqli_fetch_array($rodaScript2);

            header('location: admCuriosidades.php');
        }else{
            $sql = "insert into tblcuriosidades (foto,curiosidade,status) values ('".$foto."','".$curiosidade1."','1')";

            $rodaScript = mysqli_query($conexao,$sql);
      
      
            $rsConsulta = mysqli_fetch_array($rodaScript2);

            header('location: admCuriosidades.php');

        }
        

        // $rsConsulta = mysqli_fetch_array($rodaScript2);

        // $rsConsulta['codigo'];
    
      header('location: admCuriosidades.php');
    }
    //   echo($curiosidade1);





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
        #foto{
            width:150px;
            height:120px;
            background:;
            position: absolute;
            margin-top:-350px;
            margin-left:230px;
            box-sizing:border-box;
            background-size:cover;
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
                            <div class="tipo_adm"><a  class="link" href="<?=$permicao[0]?>">Adm. Conteúdo</a></div>
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
                        
                        <div id="caixa_logout">
                            <input type="button" id="btnLogout" value="Logout">
                        </div>
                    </div>
                    <div id="primeiraLinha">
                        <div class="fixaCentro center">
                    <div class="promocoesTitulo center">
                        <h1>Cadastro de nivel</h1><hr>
                    </div>


                    <form name="frmfoto" id="formFoto" method="post" action="../bd/upload.php" enctype="multipart/form-data">
                        <div class="fixaCentro2 center">
                            <div class="camposFrm2">
                                <div class="txtCampo2">
                                    Foto:
                                </div>
                          
                                <input type="file" name="flefoto" accept="" id="fileFoto">
                        
                            </div>
                    </form>


                <form name="frmContato" method="post" action="admCuriosidades.php">
                       
                                <!-- <div class="camposFrm">
                                    <div class="txtCampo">
                                        foto 1
                                    </div>
                                    <input type="file" name="flefoto" accept="" id="fileFoto">
                                </div> -->
                                <div class="camposFrm2">
                                    <div class="txtCampo2">
                                        Curiosidade
                                    </div>
                                    <textarea id="txtArea" name="txtArea1"><?= @$arrayConsulta['curiosidade']?></textarea>
                                </div>

                                <!-- <div class="camposFrm">
                                    <div class="txtCampo">
                                        foto 1
                                    </div>
                                    <input name="fleFoto" type="file">
                                </div> -->
  
                                <div id="foto">
                                     <img height="130" width="140"
                                      src="../bd/arquivos/<?= @$arrayConsulta['foto']?>" >  
                                </div>
                                <div id="btnEnviar_div">
                                    <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                                
                                </div>
                        </div>   
            </form>
            
            <div class="divDados3">
                            <div class="nomeNivel2">
                                <h1>Curiosidade</h1>
                            </div>
                            <div class="nomeNivel2">
                                <h1>Foto</h1>
                            </div>
   

            </div>

            <div id="divCuriosidades">
                <?php while($rsConsulta = mysqli_fetch_array($rodaScript2)){
                    ?>
                <div id="areaCuriosidades">
                        <div class="box-curiosidades"><?=$rsConsulta['curiosidade']?></div>
                        <div class="box-curiosidades"><?=$rsConsulta['foto']?></div>
                        <div class="admNome3">
                                <a href="admCuriosidades.php?modo=excluir&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/excluir.png"></a>
                                <a href="admCuriosidades.php?modo=editar&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/editar.png"></a>
                                <a href="admCuriosidades.php?modo=mudar&codigo=<?= $rsConsulta['codigo']?>&status=<?=$rsConsulta['status']?>"><img src="../imagens/<?=$rsConsulta['status']?>.png"></a>

                        </div>
                </div>

                <?php }  ?>
            </div>
        </div>
    </div>
</body>
</html>