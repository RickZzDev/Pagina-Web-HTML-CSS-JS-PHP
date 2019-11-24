<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

  

    $sql = " select * from tbllojas where status = 1";

    $rodaScript = mysqli_query($conexao,$sql);

    @$login = $_GET['inputLogin'];
    @$senha = $_GET['inputSenha'];
    $senha_cript = md5($senha);

    if(isset($_GET['btnLogin'])){
       
        $sql = "select * from tblusuario where login ='".$login."' and senha='".$senha_cript."' and status = 1";
    
        $rodaScript = mysqli_query($conexao,$sql);
    
        if($array = mysqli_fetch_array($rodaScript)){
            $_SESSION['codigoLogin'] = $array['codigo'];
            header('location:cms/admUsuarios.php');
        }else{
            echo("<script>alert ('usuario desativado')</script>");
        }
            
    }


?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <title>Projeto Pagina5</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styleLoja.css">
        
    </head>
    <body >
        <div id="segura_caixa_menu">
            <div id="caixa_menu">
                <div id="caixa_logo">
                </div>
                <div id="segura_menu_itens">
                    <div class="menu_itens pop"><a href="Loja.php">Home</a>
                        </div>
                        <div class="menu_itens pop"><a href="curiosidades.php">Curiosidades</a></div>
                        <div class="menu_itens pop"><a href="Promocoes.php">Promoções</a></div>
                            <div class="menu_itens pop"><a href="sobre.php">Sobre</a></div>
                        <div class="menu_itens pop"><a href="Loja.php">Loja</a></div>
                            <div class="menu_itens pop"><a href="ProdutoMes.php">Produto do mês</a></div>
                             <div class="menu_itens pop"><a href="contato.php">Entre em contato</a></div>
                                    
                </div>
                <div id="caixa_login">
                    <form method="get" action="Loja.php" name="frmLogin">
                        <div id="caixa_usuario">
                            <div class="usuario">
                                <p>Usuario</p>
                            </div>
                            <div id="txtUsuario">
                                <input name="inputLogin" type="text" value="" placeholder="Digite seu usuario"  id="input_login">
                            </div>
                        </div>
                        <div id="caixa_senha">
                              <div class="usuario">
                                <p>Senha</p>
                                </div>
                             <div id="txtSenha">
                                <input name="inputSenha" type="password" value="" placeholder="*********" id="input_senha">
                                <div id="btnLogin" class="pop">
                                    <input name="btnLogin" type="submit" value="Entrar"
                                        id="input_logar">   
                                </div>                                 
                            </div>                           
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>    
        <div id="caixa_slider">




        </div>
      
            <?php  
                $i=0;
             while($arrayConsulta = mysqli_fetch_array($rodaScript)){ 
                
               
               
                if($i==1){
                    $classeCss = (String) 'segundaLinha';
                }else{
                    $classeCss = (String) 'primeiraLinha';
                }

                $i++;
        
                ?>


        
            <div id="<?=$classeCss?>">
                <div class="fixaCentro center">
                    <div id="lojaTitulo" class="center">
                            <h1>Lojas</h1><hr>  
                     </div>                   
                      <div class="imgPizzaria">
                        <img src="bd/arquivos/<?=$arrayConsulta['foto']?>" height="350" width="550" alt="imagem nao encontrada"> 
                     </div>
                      <div class="divTexto">
                        <div class="endereco"><?=$arrayConsulta['rua']?>,
                         <?=$arrayConsulta['numero']?><br><?=$arrayConsulta['cidade']?>-
                         <?=$arrayConsulta['estado']?>
                        </div>
                        <div class="horario">Aberto das <?=$arrayConsulta['hora_abre']?> até as <?=$arrayConsulta['hora_fecha']?>
                        , <?=$arrayConsulta['dia_inicial']?>-<?=$arrayConsulta['dia_final']?></div>
                        <div class="referencia">Ponto de referência: <?=$arrayConsulta['referencia']?></div>
                          
                        <div class="btnChegar center"><a href="https://www.google.com/maps/place/Av.+Paulista,+São+Paulo+-+SP/@-23.5630994,-46.6565765,17z/data=!3m1!4b1!4m5!3m4!1s0x94ce59c8da0aa315:0xd59f9431f2c9776a!8m2!3d-23.5631043!4d-46.6543825">Como chegar</a></div>
                      </div>                    
                </div>
            </div>
                
               <?php  } ?>

            <!-- <div id="segundaLinha">
                <div class="fixaCentro center">
                        <div class="imgPizzaria">
                        <img src="imagens/imgLoja2.jpg" height="350" width="550" alt="imagem nao encontrada">  
                         </div>  
                     <div class="divTexto">
                        <div class="endereco">Avenida paulista, numero 666<br>São Paulo-SP</div>
                         <div class="horario">Aberto das 10 até as 22h, domingo-domingo</div>
                        <div class="referencia">Ponto de referência: Proximo ao Senai</div>
                          <div class="btnChegar center"><a href="https://www.google.com/maps/place/Av.+Paulista,+São+Paulo+-+SP/@-23.5630994,-46.6565765,17z/data=!3m1!4b1!4m5!3m4!1s0x94ce59c8da0aa315:0xd59f9431f2c9776a!8m2!3d-23.5631043!4d-46.6543825">Como chegar</a></div>
                     </div>              
                </div>
            </div>
            <div id="terceiraLinha">
                <div class="fixaCentro center">
                      <div class="imgPizzaria">
                        <img src="imagens/imgLoja3.jpg" height="350" width="550" alt="imagem nao encontrada">  
                     </div>
                      <div class="divTexto">
                        <div class="endereco">Avenida paulista, numero 666<br>São Paulo-SP</div>
                        <div class="horario">Aberto das 10 até as 22h, domingo-domingo</div>
                        <div class="referencia">Ponto de referência: Proximo ao Senai</div>
                           <div class="btnChegar center"><a href="https://www.google.com/maps/place/Av.+Paulista,+São+Paulo+-+SP/@-23.5630994,-46.6565765,17z/data=!3m1!4b1!4m5!3m4!1s0x94ce59c8da0aa315:0xd59f9431f2c9776a!8m2!3d-23.5631043!4d-46.6543825">Como chegar</a></div>
                      </div>                    
                </div>
            </div>      
              -->


                 
            

           

        
        <!-- Rodape -->
        
        <footer id="roda">
            <div id="alinha_rodape">
                <form name="btnSistema" method="get" action="ProjetoPagina1.html">
                    <div id="caixa_sistema_interno">
                        Sistema Interno
                    </div>

                    <div id="caixa_endereco">
                        Endereço: xxxxxxxxxxxx xxxxx xxx<br>
                        Telefone: xxxx xxxx<br>
                        CEP: xxxxxxx

                    </div>

                    <div id="logo_app">

                    </div>
                    <div id="caixa_baixa_app">
                        Baixar App
                    </div>
                </form> 
            </div>    
        </footer>

    </body>
</html>