<?php


    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();




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
        <title>Projeto Pagina3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/stylePromocoes.css">

    </head>
    <body >
        <div id="segura_caixa_menu">
            <div id="caixa_menu">
                <div id="caixa_logo">
                </div>
                <div id="segura_menu_itens">
                       <div class="menu_itens pop"><a href="Promocoes.php">Home</a>
                            </div>
                        <div class="menu_itens pop"><a href="curiosidades.php">Curiosidades</a></div>
                        <div class="menu_itens pop"><a href="Promocoes.php">Promoções</a></div>
                            <div class="menu_itens pop"><a href="sobre.php">Sobre</a></div>
                        <div class="menu_itens pop"><a href="Loja.php">Loja</a></div>
                            <div class="menu_itens pop"><a href="ProdutoMes.php">Produto do mês</a></div>
                             <div class="menu_itens pop"><a href="contato.php">Entre em contato</a></div>
                                    
                </div>
                <div id="caixa_login">
                    <form method="get" action="Promocoes.php" name="frmLogin">
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
                                <input name="inputSenha" type="text" value="" placeholder="*********" id="input_senha">
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
      
           
                <div id="primeiraLinha">
                    <div class="fixaCentro center">
                       <div id="promocoesTitulo"  class="center">
                            <h1>Promoções</h1><hr>  
                        </div>
                          <div class="caixa_promocoes">
                            <img src="imagens/propaganda2.PNG" height="300" width="400" alt="img_pizza">
                             <div class="saiba_mais1">
                                 <span class="preco_antigo">De: 39,90<br></span>
                                 <span class="preco_novo">Por: 29,90 </span> 

                             </div>
                         </div>
                        <div class="caixa_promocoes">
                            <img src="imagens/propaganda4.1.jpg" height="300" width="400" alt="img_pizza">
                             <div class="saiba_mais1">
                                 <span class="preco_antigo">De: 39,90<br></span>
                                 <span class="preco_novo">Por: 29,90 </span> 
                            </div>
                        </div> 
                    </div>    
                </div>
                <div id="segundaLinha">
                    <div  id="fixaCentro2" class="center">
                         <div class="caixa_promocoes">
                            <img src="imagens/propaganda3.png" height="300" width="400" alt="img_pizza">
                              <div class="saiba_mais1">
                                 <span class="preco_antigo">De: 39,90<br></span>
                                 <span class="preco_novo">Por: 29,90 </span>                          
                             </div>
                             </div>
                            <div class="caixa_promocoes">
                                <img src="imagens/prop5.jpg" height="300" width="400" alt="img_pizza">
                                 <div class="saiba_mais1">
                                 <span class="preco_antigo">De: 39,90<br></span>
                                 <span class="preco_novo">Por: 29,90 </span>                        
                                </div>
                            </div>                              
                         
                    </div>    
                </div>                
               <div id="terceiraLinha">
                    <div class="fixaCentro center">
                        <div id="linha_inf_promo" class="center">
                                <img src="imagens/outDoorPropaganda.jpg" height="350" width="1030" alt="img_pizza" >
                            <div id="outDoorPromo_div"> Peça pelo app e ganhe 10% de desconto</div>

                        </div>
                    </div>    
                </div>  
            

        <!-- Rodape -->
        
        <div id="roda">
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
        </div>

    </body>
</html>