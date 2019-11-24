<?php

session_start();
session_unset();
require_once('bd/conexao.php');

$conexao = conexaoMySql();



@$login = $_GET['inputLogin'];
@$senha = $_GET['inputSenha'];
$senha_cript = md5($senha);

if(isset($_GET['btnLogin'])){
 
    $sql = "select * from tblusuario where login ='".$login."' and senha='".$senha_cript."' and status = 1";
    echo($sql);
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
        <title>Home</title>
       
        <link rel="stylesheet" type="text/css" href="css/style1.css">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Elastic Image Slideshow with Thumbnail Preview" />
        <meta name="keywords" content="jquery, css3, responsive, image, slider, slideshow, thumbnails, preview, elastic" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300Playfair+Display:400italic' rel='stylesheet' type='text/css' />
		<noscript>
			<link rel="stylesheet" type="text/css" href="css/noscript.css" />
		</noscript>
    
    </head>
    <body >
        <div id="alinha_menu">
            
                <div id="caixa_menu">
                    <div id="caixa_logo">
                    </div>
                    <div id="segura_menu_itens">

                            <div class="menu_itens pop"><a href="ProjetoPagina1.php" >Home</a>
                            </div>
                        <div class="menu_itens pop"><a href="curiosidades.php" >Curiosidades</a></div>
                        <div class="menu_itens pop"><a href="Promocoes.php" >Promoções</a></div>
                            <div class="menu_itens pop"><a href="sobre.php" >Sobre</a></div>
                        <div class="menu_itens pop"><a href="Loja.php" >Loja</a></div>
                            <div class="menu_itens pop"><a href="ProdutoMes.php" >Produto do mês</a></div>
                             <div class="menu_itens pop"><a href="contato.php" >Entre em contato</a></div>

                    </div>
                    <div id="caixa_login">
                        <form method="get" action="ProjetoPagina1.php" name="frmLogin">
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
                                    <div id="btnLogar" class="pop">
                                        <input name="btnLogin" type="submit" value="Entrar"
                                            id="input_logar">   
                                    </div>                                 
                                </div>                           
                            </div>


                        </form>
                    </div>
                </div>
          
        </div>
            <div id="slider">
        <div class="container">


            <div class="wrapper">
                <div id="ei-slider" class="ei-slider">
                    <ul class="ei-slider-large">
						<li>
                            <img src="imagens/images/large/1.jpg" alt="image06"/>
                            <div class="ei-title">
                                <h2>Tradição</h2>
                                <h3>Paixão</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/2.jpg" alt="image01" />
                            <div class="ei-title">
                                <h2>Melhores</h2>
                                <h3>Massas</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/3.png" alt="image02" />
                            <div class="ei-title">
                                <h2>Preços</h2>
                                <h3>incomparaveis</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/4.jpg" alt="image03"/>
                            <div class="ei-title">
                                <h2>Feita com</h2>
                                <h3>Carinho</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/5.jpg" alt="image04"/>
                            <div class="ei-title">
                                <h2>Melhor da</h2>
                                <h3>Regiao</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/6.jpg" alt="image05"/>
                            <div class="ei-title">
                                <h2>É de dar</h2>
                                <h3>Água na boca</h3>
                            </div>
                        </li>
                        <li>
                            <img src="imagens/images/large/7.jpg" alt="image07"/>
                            <div class="ei-title">
                                <h2>Experimente</h2>
                                <h3>Agora</h3>
                            </div>
                        </li>
                    </ul><!-- ei-slider-large -->
                    <ul class="ei-slider-thumbs">
                        <li class="ei-slider-element">Current</li>
						<li><a href="#">Slide 6</a><img src="imagens/images/thumbs/1.jpg" alt="thumb06" /></li>
                        <li><a href="#">Slide 1</a><img src="imagens/images/large/2.jpg" alt="thumb01" /></li>
                        <li><a href="#">Slide 2</a><img src="imagens/images/large/3.png" alt="thumb02" /></li>
                        <li><a href="#">Slide 3</a><img src="imagens/images/large/4.jpg" alt="thumb03" /></li>
                        <li><a href="#">Slide 4</a><img src="imagens/images/large/5.jpg" alt="thumb04" /></li>
                        <li><a href="#">Slide 5</a><img src="imagens/images/large/6.jpg" alt="thumb05" /></li>
                        <li><a href="#">Slide 7</a><img src="imagens/images/large/7.jpg" alt="thumb07" /></li>
                    </ul><!-- ei-slider-thumbs -->
                </div><!-- ei-slider -->

            </div><!-- wrapper -->
        </div>
        <script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
        <script  src="js/jquery.eislideshow.js"></script>
        <script  src="js/jquery.easing.1.3.js"></script>
        <script >
            $(function() {
                $('#ei-slider').eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: 3000,
					titlesFactor		: 0
                });
            });
        </script>
            </div>
      
            <div id="caixa_conteudo">
                <div id="menu_secundario">
                  <div class="submenu_itens">
                      <div class="fatiaIcone">
                          
                      </div>
                      <div class="submenu_titulo">
                          <p>Submenu Titulo</p>
                      </div>
                      
                  </div>
                  <div class="submenu_itens">
                      <div class="fatiaIcone">
                          
                      </div>
                      <div class="submenu_titulo">
                          <p>Submenu Titulo</p>
                      </div>
                      
                  </div>
                  <div class="submenu_itens">
                      <div class="fatiaIcone">
                          
                      </div>
                      <div class="submenu_titulo">
                          <p>Submenu Titulo</p>
                      </div>
                      
                  </div>
                  <div class="submenu_itens">
                      <div class="fatiaIcone">
                          
                      </div>
                      <div class="submenu_titulo">
                          <p>Submenu Titulo</p>
                      </div>
                      
                  </div>                   
                </div>
                <div id="caixa_produtos_div">
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            
                            <span class="txtSaiba ">Saiba mais</span>
                        </div>
                    </div>
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            <span class="txtSaiba">Saiba mais</span>
                        </div>
                    </div>
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            <span class="txtSaiba ">Saiba mais</span>
                        </div>
                    </div>
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            <span class="txtSaiba ">Saiba mais</span>
                        </div>
                    </div>
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            <span class="txtSaiba ">Saiba mais</span>
                        </div>
                    </div>
                    <div class="caixa_produtos">
                        <div class="img_produto">
                        </div>
                        <div class="nome_produto">
                            <p>Nome:</p>
                        </div>
                        <div class="descricao_produto">
                            <p>Descrição:</p>
                        </div>
                        <div class="preco_produto">
                            <p>Preço:</p>
                        </div>
                        <div class="saibaMais skew-forward">
                            <span class="txtSaiba ">Saiba mais</span>
                        </div>
                    </div>                  
                </div>                
                <div id="caixa_redes">
                    <div class="icon_redes">
                        <img src="imagens/facebook.png" alt="Imagem rede social">
                    </div>
                     <div class="icon_redes">
                         <img src="imagens/instagram.png" alt="Imagem rede social">
                    </div>
                     <div class="icon_redes">
                         <img src="imagens/twitter.png" alt="Imagem rede social">
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