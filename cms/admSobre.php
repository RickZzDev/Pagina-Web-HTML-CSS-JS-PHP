<?php

    require_once('../bd/conexao.php');
    require_once('../bd/auth.php');

    $conexao = conexaoMySql();
   
    session_start();

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
    
    $sql2="select * from tblsobre";

    $rodaScript2 = mysqli_query($conexao,$sql2);

   

    if(@$_GET['modo'] =='editar'){
        $sql = 'select *  from tblsobre where codigo ='.$_GET['codigo'];
        echo($sql);
   
        $rodaScript = mysqli_query($conexao,$sql);

        $arrayConsulta = mysqli_fetch_array($rodaScript);
       
        $_SESSION['modo'] = 'editar';
        $_SESSION['codigo'] = $_GET['codigo'];

        
    }


    if(@$_GET['modo'] == 'mudar'){
        if($_GET['status'] == 0){
            $confereStatus = "select * from tblsobre where status = 1";

            $rodaConfere  = mysqli_query($conexao,$confereStatus);
            if(mysqli_num_rows($rodaConfere) >=3 ){
                echo('<script>alert("só é permitido ativar tres curiosidades e tres  textos")  </script>');
            }else{
                $updateStatus = "update tblsobre set status = 1 where codigo =".$_GET['codigo'];

                mysqli_query($conexao,$updateStatus);
                header('location: admSobre.php');
            }
        }else{
            echo('entrou aqui');
            $updateStatus = "update tblsobre set status = 0 where codigo =".$_GET['codigo'];

            mysqli_query($conexao,$updateStatus);
            header('location: admSobre.php');
        }

    }


 if(@$_GET['modo'] =='excluir'){
     $sql = 'delete from tblsobre where codigo ='.$_GET['codigo'];
     echo($sql);

     mysqli_query($conexao,$sql);
     header('location: admSobre.php');
 }

  if(isset($_POST['btnEnviar'])){

    echo("sadasd");
     
    // $confere = "select status from tblcuriosidades where status = 1";

    // $scriptConfere = mysqli_query($conexao,$confere);
 
    //   if(mysqli_num_rows($scriptConfere)>=0){
    //     echo("menos");
    // }else{
    //     echo('mais');
    // }
    $txtSobre = $_POST['txtTexto'];
    $txtTitulo = $_POST['txtTitulo'];
echo("--/".$txtSobre."/-------");
    


    if(isset($_SESSION['modo']) == 'editar' )
    {
        echo 'entrou aqui';

        $sql = "update tblsobre set text ='".$txtSobre ."', titulo = '".$txtTitulo."' where codigo =".$_SESSION['codigo'];
        mysqli_query($conexao,$sql);
        echo $sql;
        unset($_SESSION['codigo']);
        header('location: admSobre.php');
    }else{
        $confereStatus = "select * from tblsobre where status = 1";

        $rodaConfere  = mysqli_query($conexao,$confereStatus);


      
        if(mysqli_num_rows($rodaConfere) >=3 ){

            $sql = "insert into tblsobre (titulo,text,status) values ('".$txtTitulo."','".$txtSobre."','0')";
            echo($sql);
            $rodaScript = mysqli_query($conexao,$sql);
      
      
            $rsConsulta = mysqli_fetch_array($rodaScript2);

            header('location: admSobre.php');
        }else{
            $sql = "insert into tblsobre (titulo,text,status) values ('".$txtTitulo."','".$txtSobre."','1')";
            echo($sql);
            $rodaScript = mysqli_query($conexao,$sql);
      
      
            $rsConsulta = mysqli_fetch_array($rodaScript2);

            header('location: admSobre.php');

        }
        

        // $rsConsulta = mysqli_fetch_array($rodaScript2);

        // $rsConsulta['codigo'];
    
    //   header('location: admCuriosidades.php');
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
                        <h1>Cadastro de curiosidades</h1><hr>
                    </div>

              
                <form id="frmSobre" method="post" action="admSobre.php" >
                        <div class="fixaCentro2 center">
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        titulo
                                    </div>
                                    <textarea id="txtArea" maxlength="45" name="txtTitulo"><?= @$arrayConsulta['titulo']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Texto
                                    </div>
                                    <textarea id="txtArea" name="txtTexto"><?= @$arrayConsulta['text']?></textarea>
                                </div>

                                <div id="btnEnviar_div2">
                                    <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                                
                                </div>
                        </div>   
            </form>
            
            <div class="divDados">
                            <div class="nomeNivel">
                                <h1>Curiosidade</h1>
                            </div>
                            <div class="admNome">
                                <h1>titulo</h1>
                            </div>
            </div>

            <div id="divCuriosidades">
                <?php while($rsConsulta = mysqli_fetch_array($rodaScript2)){
                    ?>
                <div id="areaCuriosidades">
                        <div class="box-curiosidades"><?=$rsConsulta['titulo']?></div>
                        <div class="box-curiosidades"><?=$rsConsulta['text']?></div>
                        <div class="admNome">
                                <a href="admSobre.php?modo=excluir&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/excluir.png"></a>
                                <a href="admSobre.php?modo=editar&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/editar.png"></a>
                                <a href="admSobre.php?modo=mudar&codigo=<?= $rsConsulta['codigo']?>&status=<?=$rsConsulta['status']?>"><img src="../imagens/<?=$rsConsulta['status']?>.png"></a>

                </div>
                </div>

                <?php }  ?>
            </div>
        </div>
    </div>
</body>
</html>