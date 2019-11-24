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
        <title>Projeto Pagina6</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styleProdutoMes.css">
        
    </head>
    <body >
        <div id="segura_caixa_menu">
            <div id="caixa_menu">
                <div id="caixa_logo">
                </div>
                <div id="segura_menu_itens">
                      <div class="menu_itens pop"><a href="ProdutoMes.php">Home</a>
                            </div>
                        <div class="menu_itens pop"><a href="curiosidades.php">Curiosidades</a></div>
                        <div class="menu_itens pop"><a href="Promocoes.php">Promoções</a></div>
                            <div class="menu_itens pop"><a href="sobre.php">Sobre</a></div>
                        <div class="menu_itens pop"><a href="Loja.php">Loja</a></div>
                            <div class="menu_itens pop"><a href="ProdutoMes.php">Produto do mês</a></div>
                             <div class="menu_itens pop"><a href="contato.php">Entre em contato</a></div>
                </div>
                <div id="caixa_login">
                    <form method="get" action="ProdutoMes.php" name="frmLogin">
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
        
        <div id="primeiraLinha">
            <div class="fixaCentro center">
                       <div class="promocoesTitulo center"  >
                            <h1>Pizzas mais vendidas do mês</h1><hr>  
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
        </div>
        <div id="segundaLinha">
            <div class="fixaCentro2 center">
               <div class="promocoesTitulo center">
                    <h1>Pizzas mais bem avaliadas</h1><hr>  
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
        </div>
        <div id="terceiraLinha">
            <div class="fixaCentro center">
               <div class="promocoesTitulo center">
                    <h1>Escolhas do pizzaiolo</h1><hr>  
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
        </div>
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