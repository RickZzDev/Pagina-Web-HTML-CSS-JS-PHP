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
    

   $teste = "select * from tbllojas";

   $rodaScript2 = mysqli_query($conexao,$teste);

   $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

   $rodaScript = mysqli_query($conexao,$sql);

   $array = mysqli_fetch_array($rodaScript);

   if(isset($_GET['btnLogout'])){
       session_unset();
       header('location: ../ProjetoPagina1.php');
    }

    if(@$_GET['modo'] =='editar'){
        $sql = 'select *  from tbllojas where codigo ='.$_GET['codigo'];
        
   
        $rodaScript = mysqli_query($conexao,$sql);
        echo $sql;
        $arrayConsulta = mysqli_fetch_array($rodaScript);
        echo $arrayConsulta['foto'];
        $_SESSION['modo'] = 'editar';
        $_SESSION['codigo'] = $_GET['codigo'];
    }


    if(@$_GET['modo'] == 'mudar'){
        if($_GET['status'] == 0){
            $confereStatus = "select * from tbllojas where status = 1";

            $rodaConfere  = mysqli_query($conexao,$confereStatus);
            if(mysqli_num_rows($rodaConfere) >=3 ){
                echo('<script>alert("só é permitido ativar tres curiosidades e tres  textos")  </script>');
            }else{
                $updateStatus = "update tbllojas set status = 1 where codigo =".$_GET['codigo'];

                mysqli_query($conexao,$updateStatus);

                header('location: admLojas.php');
            }
        }else{
            echo('entrou aqui');
            $updateStatus = "update tbllojas set status = 0 where codigo =".$_GET['codigo'];

            mysqli_query($conexao,$updateStatus);

            header('location: admLojas.php');
        }

    }


 if(@$_GET['modo'] =='excluir'){
     $sql = 'delete from tbllojas where codigo ='.$_GET['codigo'];
     echo($sql);

     mysqli_query($conexao,$sql);
     header('location: admLojas.php');
 }

  if(isset($_POST['btnEnviar'])){

        //tratamento para verificar se o usuario realmente fez o upload de um arquivo
        if(isset($_SESSION['previewFoto'])){
            $foto = $_SESSION['previewFoto']; 
            echo('sim existe');
        }
            
        else
                $foto = null;

    $rua = $_POST['txtRua'];
    $numero = $_POST['txtNumero'];
    $cidade = $_POST['txtCidade'];
    $estado = $_POST['txtEstado'];
    $referencia = $_POST['txtReferencia'];
    $sltDiaAbre = $_POST['sltDia_abre'];
    $sltDiaFecha= $_POST['sltDia_fecha'];
    $sltHoraAbre = $_POST['sltHora_abre'];
    $sltHoraFecha = $_POST['sltHora_fecha'];

    echo("sadasd");
     
    $confere = "select status from tbllojas where status = 1";

    $scriptConfere = mysqli_query($conexao,$confere);
 
      if(mysqli_num_rows($scriptConfere)>=0){
        echo("menos");
    }else{
        echo('mais');
    }

    


    if(isset($_SESSION['modo']) == 'editar' )
    {
        echo('entrou');
        echo('--'.$foto);
        $sql = "update tbllojas set foto = '".$foto."', rua ='".$rua."', numero = '".$numero."',cidade = '".$cidade."', estado = '".$estado."',
        referencia = '".$referencia."', dia_inicial = '".$sltDiaAbre."', dia_final = '".$sltDiaFecha."',
        hora_abre = '".$sltHoraAbre."', hora_fecha = '".$sltHoraFecha."' 
        
        
        where codigo =".$_SESSION['codigo'];
        mysqli_query($conexao,$sql);

        unset($_SESSION['modo']);
        header('location: admLojas.php');
    }else{
        $confereStatus = "select * from tbllojas where status = 1";

        $rodaConfere  = mysqli_query($conexao,$confereStatus);


      
        if(mysqli_num_rows($rodaConfere) >=3 ){

            $sql = "insert into tbllojas (foto,rua,numero,cidade,estado,referencia,dia_inicial,dia_final,hora_abre,hora_fecha,status)
            values ('".$foto."','".$rua."','".$numero."','".$cidade."','".$estado."','".$referencia."','".$sltDiaAbre."','".$sltDiaFecha."',
            '".$sltHoraAbre."','".$sltHoraFecha."','0')";
            echo($sql);
            $rodaScript = mysqli_query($conexao,$sql);
      
            echo $sql;
            // $rsConsulta = mysqli_fetch_array($rodaScript);

            header('location: admLojas.php');
        }else{
            $sql = "insert into tbllojas (foto,rua,numero,cidade,estado,referencia,dia_inicial,dia_final,hora_abre,hora_fecha,status)
             values ('".$foto."','".$rua."','".$numero."','".$cidade."','".$estado."','".$referencia."','".$sltDiaAbre."','".$sltDiaFecha."',
             '".$sltHoraAbre."','".$sltHoraFecha."','1')";
            
             echo $sql;
            $rodaScript = mysqli_query($conexao,$sql);
      
      
            // $rsConsulta = mysqli_fetch_array($rodaScript);

            header('location: admlojas.php');

        }
        

        // $rsConsulta = mysqli_fetch_array($rodaScript);

        $rsConsulta['codigo'];
    
      header('location: admLojas.php');
    }
//     //   echo($curiosidade1);





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
    <link rel="stylesheet" href="../css/admLojas.css">
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
                $('.visualizar').click(function(){
                 
                   $('#containerModal').fadeIn(1000);
                   //slideDow, toggle, slidetoggle, fadeIn
               });
                

                $('#fechar').click(function(){
                        $('#containerModal').fadeOut(1000);
                    });

                });
           


                function visualizarDados (idItem)
                {
                  
                    $.ajax({
                        type: "POST",
                        url: "../modal.php",
                        data: {modo:'visualizar', codigo:idItem},
                        success: function(dados){
                            $('#modalDados').html(dados);
                        }
                        
                    });
                }
            
 
            
        </script>

    <style>
        #foto{
            width:150px;
            height:130px;
            background-color:gray;
            position: absolute;
            margin-top:-980px;
            margin-left:450px;
            box-sizing: border-box;
            padding-left:5px;
        }

        </style>

</head>
<body>


                    <!-- Construir a modal que ira receber os dados de outro arquivo, atraves do javaScript -->
                <div id="containerModal">
                    <div id="modal">
                        <div id="fechar"><img src="../imagens/0.png"></div>
                        <div id="modalDados"></div>
                    </div>
                </div>

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
                            <div class="tipo_adm"><a  class="link" href="<?=$permicao[2]?>">Adm. Usuários</a></div>
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
                        <h1>Cadastro de Lojas</h1><hr>
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

                <form name="frmContato" method="post" action="admlojas.php">
                     
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                       Rua:
                                    </div>
                                    <textarea class="txtArea" maxlength="45" name="txtRua"><?=@$arrayConsulta['rua']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Numero
                                    </div>
                                    <textarea class="txtArea" maxlength="45" name="txtNumero"><?=@$arrayConsulta['numero']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Cidade
                                    </div>
                                    <textarea class="txtArea" maxlength="45" name="txtCidade"><?=@$arrayConsulta['cidade']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Estado
                                    </div>
                                    <textarea class="txtArea" maxlength="45" name="txtEstado"><?=@$arrayConsulta['estado']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Ponto de referência
                                    </div>
                                    <textarea class="txtArea" maxlength="45" name="txtReferencia"><?=@$arrayConsulta['referencia']?></textarea>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Dias de funcionamento
                                    </div>
                                    <select name="sltDia_abre">
                                        <?php if($_GET['modo']){ ?>
                                            <option><?=@$arrayConsulta['dia_inicial']?></option>
                                        <?php } ?>
                                        <option>Escolha um dia</option>
                                        <option value="segunda">Segunda</option>
                                        <option value="terca">Terça</option>
                                        <option value="quarta">Quarta</option>
                                        <option value="quinta">Quinta</option>
                                        <option value="sexta">Sexta</option>

                                    </select>
                                    A
                                    <select name="sltDia_fecha">
                                    <?php if($_GET['modo']){ ?>
                                            <option><?=@$arrayConsulta['dia_final']?></option>
                                        <?php } ?>
                                        <option>Escolha um dia</option>
                                        <option value="segunda">Segunda</option>
                                        <option value="terca">Terça</option>
                                        <option value="quarta">Quarta</option>
                                        <option value="quinta">Quinta</option>
                                        <option value="sexta">Sexta</option>
                                        <option value="sabado">Sábado</option>]
                                        <option value="domingo">Domingo</option>

                                    </select>
                                </div>
                                <div class="camposFrm">
                                    <div class="txtCampo">
                                        Horario de funcionamento
                                    </div>
                                    <select name="sltHora_abre">
                                    <?php if($_GET['modo']){ ?>
                                            <option><?=@$arrayConsulta['hora_abre']?></option>
                                        <?php } ?>
                                        <option>Escolha uma hora</option>
                                        <?php for($i = 0 ; $i<=24;$i++){ ?>
                                             <option value="<?=$i?>"><?=$i?></option>

                                        <?php }  ?>
                                       
                    

                                    </select>
                                    A
                                    <select name="sltHora_fecha">
                                    <?php if($_GET['modo']){ ?>
                                            <option><?=@$arrayConsulta['hora_fecha']?></option>
                                        <?php } ?>
                                    <option>Escolha uma hora</option>
                                        <?php for($i = 0 ; $i<=24;$i++){ ?>
                                             <option value="<?=$i?>"><?=$i?></option>

                                        <?php }  ?>

                                    </select>

                                    <div id="foto">
                                            <img src="../bd/arquivos/<?=@$arrayConsulta['foto']?>"
                                             height="130" width="140">
                                    </div>
                                </div>

  

                                <div id="btnEnviar_div">
                                    <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                                
                                </div>
                        </div>   
            </form>
            
            <div class="divDados">
        
                            <div class="admNome">
                                <h3>Rua</h3>
                            </div>
                            <div class="admNome">
                                <h3>Numero</h3>
                            </div>
                            <div class="admNome">
                                <h3>Cidade</h3>
                            </div>

    
       
                            <div class="admNome">
                                <h3>foto</h3>
                            </div>
        
   

            </div>

            <div id="divCuriosidades">
                <?php  while($rsConsulta = mysqli_fetch_array($rodaScript2)){
                    ?>
                <div id="areaCuriosidades">
                        <div class="box-curiosidades"><?=$rsConsulta['rua']?></div>
                        <div class="box-curiosidades"><?=$rsConsulta['numero']?></div>
                        <div class="box-curiosidades"><?=$rsConsulta['cidade']?></div>
                       
      
                        <div class="box-curiosidades">
                            <img src="../bd/arquivos/<?=$rsConsulta['foto']?>" height="100" width="100">
                        </div>
                   
                        <div class="admNome">
                                <a href="admLojas.php?modo=excluir&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/excluir.png"></a>
                                <a href="admLojas.php?modo=editar&codigo=<?= $rsConsulta['codigo']?>"><img src="../imagens/editar.png"></a>
                                <a href="admLojas.php?modo=mudar&codigo=<?= $rsConsulta['codigo']?>&status=<?=$rsConsulta['status']?>"><img src="../imagens/<?=$rsConsulta['status']?>.png"></a>
                         
                                <a href="#" class="visualizar" onclick="visualizarDados(<?=$rsConsulta['codigo']?>)">
                                    <img src="../imagens/lupa2.png">
                                </a>
                    

                        </div>
                </div>

                <?php }  ?>
            </div>
        </div>
    </div>
</body>
</html>