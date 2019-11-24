<?php
    //Verifica se existe a variavel modo
    if(isset($_POST['modo']))
    {
        //Valida se o conteudo da variavel modo é visualizar
        if( $_POST['modo'] == 'visualizar')
        {
            //Recebe o id do registro enviado pelo AJAX
            $codigo = $_POST['codigo'];
            
            //Import no arquivo de conexão
            require_once('bd/conexao.php');
    
            //Chamada para estabelecer a conexão com o Banco de Dados
            $conexao = conexaoMysql ();
            
            //Script para buscar o registro no banco de dados
            $sql = "select * from tbllojas
                    where codigo =".$codigo;
            
            //Executa o script no banco de dados
            $select = mysqli_query($conexao, $sql);
            
            //Verifica se existem dados, e converte em array
            if($rsVisualizar = mysqli_fetch_array($select))
            {
                $rua = $rsVisualizar['rua'];
                $numero = $rsVisualizar['numero'];
                $cidade = $rsVisualizar['cidade'];
                $estado = $rsVisualizar['estado'];
                $referencia = $rsVisualizar['referencia'];
                $diaAbre = $rsVisualizar['dia_inicial'];
                $diaFecha = $rsVisualizar['dia_final'];
                $horaAbre = $rsVisualizar['hora_abre'];
                $horaFecha = $rsVisualizar['hora_fecha'];
                $foto = $rsVisualizar['foto'];
          
                
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            #tblModal{
                width:450px;
                height:350px;
                background: rgb(0,0,0);
                background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(78,76,76,1) 42%, rgba(131,131,131,1) 100%);
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
                        <div class="box_campo">Rua:</div>
                        <div class="box_campo"><?=$rua?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Numero:</div>
                    <div class="box_campo"> <?=$numero?></div>
                </div>
                
                <div class="linhaRegistro">
                        <div class="box_campo">Cidade:</div>
                        <div class="box_campo"><?=$cidade?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Estado:</div>
                    <div class="box_campo"> <?=$estado?></div>
                </div>
                <div class="linhaRegistro">
                        <div class="box_campo">Ponto de referencia:</div>
                        <div class="box_campo"><?=$referencia?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Dias de Funcionamento:</div>
                    <div class="box_campo">De:<?=$diaAbre?> até <?=$diaFecha?></div>
                </div>

                <div class="linhaRegistro">
                    <div class="box_campo">Horario de funcionamento:</div>
                    <div class="box_campo">Das:<?=$horaAbre?> as <?=$horaFecha?></div>
                </div>
                <div class="linhaRegistro">
                    <div class="box_campo">Horario de funcionamento:</div>
                    <div class="box_campo"><img src='../bd/arquivos/<?=$foto?>' width="30" height="30"></div>
                </div>
            </div>
    </body>
</html>