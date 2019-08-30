<?php

/*Chamando a função*/



$n1 = 0;
$n2 = 0;
$resultado;
$rdo;

const ERROR_EMPTY = "Favor Digitar todos os campos";
const NON_NUMERIC = "Favor digitar apenas numeros";

        $chkSomar = "";
    $chkSubtrair = "";
    $chkMultiplicar = "";
    $chkDividir = "";

if(isset($_POST['btnCalc'])){
    

    
    @$rdo = $_POST['rdoOp'];
        if($rdo=="")
        $resultado = "Favor escolher uma operação";
    $n1 = $_POST["txtN1"];
    $n2 = $_POST["txtN2"];
    
    
        /*Tratando erro ao digitar outro carecter alem de numero*/
    if(is_numeric($n1) && is_numeric($n2))
    {
        if($rdo == "Somar")
        {
            $resultado = $n1 + $n2;
            $chkSomar = "checked";            
        }

            
        if($rdo == "Subtrair")
        {
            $resultado = $n1 - $n2;
            $chkSubtrair = "checked";        
        }
            
        if($rdo == "Dividir")
        {
            @$resultado = $n1 / $n2;
            $chkDividir = "checked";           
        }

        
        if($rdo == "Multiplicar")
        {
            $resultado = $n1 * $n2;           
            $chkMultiplicar = "checked";           
        }

    }
    
    if($n2==0)
        $resultado = "não existe divisão por zero";
    
    if(!is_numeric($n1) || !is_numeric($n2))
        $resultado = NON_NUMERIC;
    if($n1 == "" || $n2 =="")
    {
        $resultado = ERROR_EMPTY;
    } 
    
   
}

?>

<html>
    <head>
        <title>
            Pagina 1
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/styleIf.css">
    </head>
    
    <body>
        <div id="linhaSup">
            <div id="menu_caixa">
                <div id="menu">
                    <div id="submenu">
                        <div class="submenu_itens">
                           <a href="Pagina1.php">Home</a> 
                        </div>                        
                        <div class="submenu_itens">
                           <a href="Media.php">Media</a> 
                        </div>
                         <div class="submenu_itens">
                             <a href="CalcIf.php"> 
                                 Calculadora com If
                             </a>
                        </div>
                           <div class="submenu_itens">
                             <a href="CalcSwitch.php"> 
                                    Calculadora com switch
                             </a>
                        </div>                      
                         <div class="submenu_itens">
                             <a href="Calculadora.php"> 
                               Calculadora com função
                             </a>
                        </div> 

                         <div class="submenu_itens">
                            <a href="Tabuada.php">
                             Tabuada
                             </a>
                        </div>
                         <div class="submenu_itens">
                            <a href="Select.php">Pares e Impar
                             </a>
                        </div>                           
                    </div>
                 </div>
            </div> 
            
            <div id="calc_caixa">
                <div id="caixa_titulo">
                    <div id="auxilia1"><h2>Calculadora</h2></div>
                </div>
                <div id="caixa_inferior">
                    <form name="frmCalc" method="post" action="CalcIf.php">
                    <div id="linha_sup">
                        <div id="numeros">
                            Numero 1 <input type="text" name="txtN1" value="<?=$n1?>"><br><br>
                            Numero 2 <input type="text" name="txtN2" value="<?=$n2?>"><br><br>
                            <input name="rdoOp" type="radio" value="Somar" <?=$chkSomar?>>Somar<br>     
                            <input name="rdoOp" type="radio" value="Subtrair" <?=$chkSubtrair?>>Subtrair<br> 
                            <input name="rdoOp" type="radio" value="Multiplicar" <?=$chkMultiplicar?>>Multiplicar<br>
                            <input name="rdoOp" type="radio" value="Dividir" <?=$chkDividir?>>Dividir<br>
                        </div>

                        <div id="DivBtnCalc">
                            <input type="submit" name="btnCalc" value="Calcular">
                        </div>                    
                    </div>    

                        
                    <div id="divResultado">
                        <?php echo(@$resultado)?>
                    </div>
                    </form>
                </div>
            </div>        
        </div>
    </body>
</html>