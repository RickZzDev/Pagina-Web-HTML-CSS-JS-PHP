<?php

    session_start();

    require_once('bd/conexao.php');

    $conexao = conexaoMySql();

    $sql = "select * from tblcuriosidades where status = 1";

    $script = mysqli_query($conexao,$sql);


    
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

    // Array que pega os ids dos ativos

    
    // Array que ira guardar os textos
    // $arrayTxts = array();
    
    // este loop ira resgatar as curiosidades do banco e guardar em um array acumulativo
    // for($i = 0; $i <=2; $i++){
    //     settype($i, 'string');
    //     $sql = "select * from tblcuriosidades where codigo =".$arrayCuriosidades[$i];

    //     $script1 = mysqli_query($conexao,$sql);


    //     $curiosidade = mysqli_fetch_array($script1);

    //     array_push($arrayTxts, $curiosidade['curiosidade']);


        
    //     // echo $i;
    //     settype($i, 'integer');
    // }

    // var_dump($arrayTxts);

    // $sql = "select * from tblcuriosidades where codigo =".$arrayCuriosidades['0'];

    // $script1 = mysqli_query($conexao,$sql);

    // $curiosidade1 = mysqli_fetch_array($script1);

    // echo($curiosidade1['codigo'])
   
  

?>
<!DOCTYPE html> 

<html lang="pt-br">
    <head>
        <title>Projeto Pagina2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/styleCuriosidades.css">

    </head>
    <body >
        <header id="segura_caixa_menu">
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
                    <form method="get" action="curiosidades.php" name="frmLogin">
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
        </header>    
        <div id="caixa_slider">

         


        </div>
      
        <?php
        
            $i = 0;
            while( $array = mysqli_fetch_array($script)) {
                
                if($i==2){ ?>
                    <div id="primeiraLinha">
                    <div class="fixaCentro center">

                        <div class="linhaCuriosidades">
                            <div id="imgCuriosidades"><img height="100%" width="100%" src="bd/arquivos/<?=$array['foto']?>"></div>
                            <div class="textoCuriosidades">
                                <p>
                                    
                                    <?=$array['curiosidade']?>
                                </p>
                            </div>



                        </div>
                    </div>    
                </div>
               <?php }
                elseif($i==0) { ?>

                <div id="primeiraLinha">
                    <div class="fixaCentro center">
                        <div id="curiosidadesTitulo" class="center">
                            <h1>Curiosidades</h1><hr>
                        </div>
                        <div class="linhaCuriosidades">
                            <div id="imgCuriosidades"> <img height="100%" width="100%" src="bd/arquivos/<?=$array['foto']?>"></div>
                            <div class="textoCuriosidades">
                                <p>
                                    
                                <?=$array['curiosidade']?>
                                </p>
                            </div>



                        </div>
                    </div>    
                </div>



               <?php }else{ ?>

                <div id="segundaLinha">
                    <div class="fixaCentro center">
                          <div class="linhaCuriosidades">
                            <div id="imgCuriosidades2" >
                                <img height="100%" width="100%" src="bd/arquivos/<?=$array['foto']?>">
                            </div>
                            <div class="textoCuriosidades">
                                <p>
                                    <?=$array['curiosidade']?>
                                </p>
                            </div>
                        </div>
                    </div>    
                </div>

                <?php } $i++; ?>
                
            
                
           


            <?php } ?>

                 

<!--                 
                <div id="terceiraLinha">
                    <div class="fixaCentro center">
                         <div class="linhaCuriosidades">
                            <div id="imgCuriosidades3" >
                               <img src="imagens/curiosidades2.jpg" height="350" width="450">
                            </div>
                            <div class="textoCuriosidades">
                                <p>
                                    <?=$arrayTxts[2]?>
                                </p>                                

                            </div>
                        </div>
                    </div>    
                </div> -->
           
       
            

        
        <!-- Rodape -->
        
        <footer id="roda">
            <div id="alinha_rodape">
                <form name="btnSistema" method="get" action="curiosidades.php">
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