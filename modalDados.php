<?php 

        
        require_once('bd/conexao.php');

        $conexao = conexaoMySql();

       
//verifica se existe a variavel modo
    if(isset($_POST['modo']))
        
    {
        //valida se o conteudo da variavle modo é visualizar
        if(strtoupper( $_POST['modo']) == 'VISUALIZAR'){
            //recebe o id do registro enviado pelo ajax
                $codigo = $_POST['codigo'];

                $sql = "select  * from tblcontatos
                            where codigo = ".$codigo;
                            
                //executa o script no bacno de dados
                $select = mysqli_query($conexao,$sql);
                //Verifica se existem dados e converte em um array
                if($rsVisualizar = mysqli_fetch_array($select)){

                        $nome = $rsVisualizar['nome'];
                        $telefone = $rsVisualizar['telefone'];
                        $celular = $rsVisualizar['celular'];
                        $email = $rsVisualizar['email'];
                        $sexo = $rsVisualizar['sexo'];
                        $home_page = $rsVisualizar['home_page'];
                        $sugestao = $rsVisualizar['sugestao_critica'];
                        $link_facebook = $rsVisualizar['link_facebook'];
                        $profissao = $rsVisualizar['profissao'];
                        $mensagem = $rsVisualizar['mensagem'];
                        
                    

                }
                
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
            #tblModal{
                width:450px;
                height:350px;
                background:red;
                margin-left:auto;
                margin-right:auto;
                border-radius:50px;
                margin-top:50px;
            }

            .nomeCampo{
                width:20px;
                height:20px;
                background:red;
            }

            .linhaRegistro{
                width:100%;
                height:50px;
                background:yellow;
                display:flex;
                flex-direction:row;
                justify-content:space-around;
            }

            .box_campo{
                width:50%;
                height:inherit;
                background: gray;
                padding:15px;
                box-sizing:border-box;
            }
        
        </style>
</head>
<body>


<div id="tblModal">
                <div class="linhaRegistro">
                        <div class="box_campo">Nome</div>
                        <div class="box_campo"><?=$nome?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Telefone:</div>
                    <div class="box_campo"> <?$telefone?></div>
                </div>
                
                <div class="linhaRegistro">
                        <div class="box_campo">Celular:</div>
                        <div class="box_campo"><?=$celular?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Email:</div>
                    <div class="box_campo"> <?=$email?></div>
                </div>
                <div class="linhaRegistro">
                        <div class="box_campo">Sexo:</div>
                        <div class="box_campo"><?=$sexo?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Home Page:</div>
                    <div class="box_campo"><?=$home_page?> </div>
                </div>

                <div class="linhaRegistro">
                    <div class="box_campo">Link Facebook:</div>
                    <div class="box_campo"><?=$link_facebook?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Tipo de mensagem</div>
                    <div class="box_campo"><?=$sugestao?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Mensagem:</div>
                    <div class="box_campo"><?=$mensagem?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Profissão:</div>
                    <div class="box_campo"><?=$profissao?></div>
                </div>
            </div>
        
</body>
</html>