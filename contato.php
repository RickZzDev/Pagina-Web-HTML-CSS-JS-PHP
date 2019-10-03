

<!DOCTYPE html> 

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Projeto Pagina7.2</title>
        <meta  name="viewport" content="width=device-width, initial-scale=1" >
        
        <link rel="stylesheet" href="css/styleContato.css">
        <script src="Js/scriptValida.js"></script>
    </head>
    <body >
        <div id="segura_caixa_menu">
            <div id="caixa_menu">
                <div id="caixa_logo">
                </div>
                <div id="segura_menu_itens">
                            <div class="menu_itens pop"><a href="ProjetoPagina1.html">Home</a>
                            </div>
                        <div class="menu_itens pop"><a href="curiosidades.html">Curiosidades</a></div>
                        <div class="menu_itens pop"><a href="Promocoes.html">Promoções</a></div>
                            <div class="menu_itens pop"><a href="sobre.html">Sobre</a></div>
                        <div class="menu_itens pop"><a href="Loja.html">Loja</a></div>
                            <div class="menu_itens pop"><a href="ProdutoMes.html">Produto do mês</a></div>
                             <div class="menu_itens pop"><a href="contato.html">Entre em contato</a></div>
                                    
                </div>
                <div id="caixa_login">
                    <form method="get" action="contato.php" name="frmLogin">
                        <div id="caixa_usuario">
                            <div class="usuario">
                                <p>Usuario</p>
                            </div>
                            <div id="txtUsuario">
                                <input name="txtUsuario" type="text" value="" placeholder="Digite seu usuario"  id="input_login">
                            </div>
                        </div>
                        <div id="caixa_senha">
                              <div class="usuario">
                                <p>Senha</p>
                                </div>
                             <div id="txtSenha">
                                <input name="txtSenha" type="text" value="" placeholder="*********" id="input_senha">
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
                <div class="promocoesTitulo center">
                    <h1>Entre em contato conosco</h1><hr>
                </div>
                    <form name="frmContato" method="post" action="contato.php">
                    <div class="fixaCentro2 center">
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Nome:
                            </div>
                            <input type="text" id="txtNome" value="" placeholder="Digite seu nome" name="txtNome" required onkeypress=" return validarEntrada(event,2)" maxlength="45">
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                Telefone
                            </div>
                            <input type="text" id="txtTelefone" value="" placeholder="Digite seu telefone" name="txtTelefone" onkeypress="return mascaraNumero(this,event,1);"  maxlength="14" >
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Celular:
                            </div>
                            <input type="text" id="txtCelular" value="" placeholder="Digite seu celular" name="txtCelular" required onkeypress="return mascaraNumero(this,event,1);" maxlength="15">
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Email:
                            </div>
                            <input type="email" id="txtEmail" placeholder="Digite seu email" name="txtEmail"  required>
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                Home Page
                            </div>
                            <input type="text" id="txtHomePage" placeholder="Digite sua pagina pessoal" name="txtHomePage">
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                Link no Facebook
                            </div>
                            <input type="text" id="txtFacebook" placeholder="Digite o link do seu facebook" name="txtFacebook">
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                Sugestão/Críticas 
                            </div>
                            <select name="sugestao" value="">
                                <option value="">
                                    Escolha uma opção 
                                </option>
                                <option value="sugestao">
                                    Sugestão
                                </option>
                                <option value="critica">
                                    Critica
                                </option>                                
                            </select>

                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Mensagem:
                            </div>
<!--                            <input type="text" id="txtMensagem" placeholder="Envie-nos uma mensagem"  name="txtMensagem" required>-->
                            <textarea  required name="txtMensagem" id="txtMensagem" placeholder="Envie-nos uma mensagem"></textarea>
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Sexo
                            </div>
                            <input type="radio"  name="rdoSexo" value="Masculino" required>Maculino
                            <input type="radio"  name="rdoSexo" value="Feminino" required>Feminino
                        </div>
                        <div class="camposFrm">
                            <div class="txtCampo">
                                *Profissão:
                            </div>
                            <input type="text" id="txtProfissao"
                            placeholder="Digite sua profissão" name="txtProfissao" required>
                        </div>
                        <div id="btnEnviar_div">
                            <input type="submit" id="btnEnviar" value="Enviar" name="btnEnviar">
                          
                        </div> 
                    </div>   
                </form>    
            </div>
        </div>
        <!-- Rodape -->
        
        <footer id="roda">
            <div id="alinha_rodape">
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
            </div>   
        </footer>

    </body>
</html>


<?php

    require_once("bd/conexao.php");

    $conexao = conexaoMySql();

    $select = $_POST['sugestao'];
    
    if($select=="sugestao" || $select=="critica")
        echo("fooi");
    
    if(isset($_POST['btnEnviar'])){
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $email = $_POST['txtEmail'];
        $homePage =  $_POST['txtHomePage'];
        $linkFacebook = $_POST['txtFacebook'];
        $sugestao = $_POST['sugestao'];
        $mensagem = $_POST['txtMensagem'];
        $sexo = $_POST['rdoSexo'];
        $profissao = $_POST['txtProfissao'];
        
        
        $sql = "insert into tblcontatos (nome,telefone,celular,email,home_page,link_facebook,sugestao,mensagem,sexo,profissao) values ('".$nome."', '".$telefone."' , '".$celular."' , '".$email."', '".$homePage."' , '".$linkFacebook."' , '".$sugestao."' , '".$mensagem."' , '".$sexo."' , '".$profissao."' )";
        
        if(mysqli_query($conexao,$sql))
            header('location:contato.php');
        else
            echo('Erro ao enviar ao banco');
    }
?>