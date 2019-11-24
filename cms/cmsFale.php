<?php
   
    session_start();
    require_once('../bd/auth.php');
    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();
    
    if(isset($_SESSION['codigoLogin'])){
        echo 'existe';
    }else{
        echo 'nao existe';
    }

    $permicao = autenticar($_SESSION['codigoLogin']);
    
    var_dump($permicao);
    
    
    if(isset($_GET['modo'])=="excluir"){
        
        $codigo = $_GET['codigo'];
        
        $sql = "delete from tblcontatos where codigo=" . $codigo;

        $delete = mysqli_query($conexao,$sql);
    }

    
    $sql = "select nome from tblusuario where codigo =".$_SESSION['codigoLogin'];

    $rodaScript = mysqli_query($conexao,$sql);

    $array = mysqli_fetch_array($rodaScript);

    if(isset($_GET['btnLogout'])){
        session_unset();
        header('location: ../ProjetoPagina1.php');
     }
    
    
 
    
?>

<html>
    <head>
        <title>
            Formulario
        </title>
        
        <link rel="stylesheet" type="text/css" href="../css/stykeCmsFale.css">
        <link rel="stylesheet" type="text/css" href="../css/styleContato.css">
        <script src="../Js/jquery.js"></script>
        <script>
            
           $(document).ready(function(){
              
              
                //function que abre a modal
               $('.visualizar').click(function(){               
                    $('#modal_caixa').fadeIn(1000);
               });
              $('#fechar').click(function(){
                  
                    $('#modal_caixa').fadeOut(1000);
               });
            });
            

            function visualizarDados(id){
                
                $.ajax({
                    
                    type:'POST',
                    url:"../modalDados.php",
                    data:{modo:"visualizar",codigo:id},
                    success: function(dados)
                    {
                        $('#modalDados').html(dados);
                    }
                });
            }




        </script>
    </head>
    
    <body>
            <div id="modal_caixa">
                <div id="modal">
                    <div id="fechar"><img src="../imagens/0.png"></div>
                    <div id="modalDados"></div>
                </div>
            </div>
        <main id="container_geral" class="center">
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
            
            
            <!-- Paginas para serem modificadas -->
            
            <div id="area_paginas">
                 <form method="GET" action="cmsFale.php">
                <div id="caixa_filtro" class="center">
                    <select name="sltMensagem" id="sltMensagem">
                        <option>Sem filtro</option>
                        <option value="sugestao">Sugestão</option>
                        <option value="critica">Criticas</option>
                    </select>
                    <input type="submit" name="btnFiltro" id="btnFiltro">
                </div>
                <div id="area_tabela">
                    <div id="titulo_consulta">
                        <h1>Tabela de consultas</h1>
                    </div>
                    <div id="linha_cadastros">
                        <div class="nome_campo">
                            Nome:
                        </div>
                         <div class="nome_campo">
                             Telefone:
                        </div>
                         <div class="nome_campo">
                             Celular:
                        </div>
                         <div class="nome_campo">
                             Email:
                        </div>
                         <div class="nome_campo">
                             Home Page:
                        </div>
                    </div>
                   
                    <?php
                        //variavel que guarda o script a ser executado
                        $sql = "select * from tblcontatos";
                        
                        //Este select ira fazer a conexao com o banco e rodar um script dentro dele
                        
                        
                           if(isset($_GET['btnFiltro'])){
                               $sltMensagem = $_GET['sltMensagem'];
                            
                               if($sltMensagem == "sugestao"){
                                 $sql = "select * from tblcontatos where sugestao_critica = 'sugestao'";
                               }elseif($sltMensagem == "critica"){
                                   $sql = "select * from tblcontatos where sugestao_critica = 'critica'";
                               }
                                
                            }
                    
                        $select = mysqli_query($conexao,$sql);
                        //Este loop ira verificar se algo esta retornando, se estiver, o loop ira trazer tudo
                        while($rsConsultas = mysqli_fetch_array($select)){
                            
                        ?>
                        
                    <div id="linha_form">
                        <div class="campo_consulta">
                            <?php
                                echo($rsConsultas['nome']);
                                
                            ?>
                        </div>
                        <div class="campo_consulta">
                            <?php
                            echo($rsConsultas['telefone']);
                            ?>
                        </div>
                        <div class="campo_consulta">
                            <?php
                            echo($rsConsultas['celular']);    
                            ?>
                        </div>
                        <div class="campo_consulta">
                            <?php
                            echo($rsConsultas['email']);
                            ?>
                        </div>
                        <div class="campo_consulta">
                            <?php
                            echo($rsConsultas['home_page']);
                            
                            ?>
                        </div>
                        <div class="campo_consulta campoImg">
                            <div class="icones"><a href="cmsFale.php?modo=excluir&codigo=<?=$rsConsultas['codigo'] ?>" onclick ="return confirm('Deseja realmente excluir esse arquivo')">
                                <img src="../imagens/trash.png"></a></div>
                            
                            <a href="#" class="visualizar" onclick="visualizarDados(<?=$rsConsultas['codigo']?>);"><div class="icones bg1"></div></a>
                        </div>

                    </div>
                     <?php }?>
                      </form>   
                </div>
                      
            </div>
            <!-- Area do rodapé-->
            <footer id="rodape">
            
            </footer>
        </main>
    </body>
</html>