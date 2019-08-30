<?php


require_once('MODULOS/media.php');

$n1 = 0;
$n2 = 0;
$n3 = 0;
$n4 = 0;
$resultado;

const ERROR_EMPTY = "Favor Digitar todos os campos";
const NON_NUMERIC = "Favor digitar apenas numeros";

if(isset($_POST['btnCalc']))
{
    $n1 = $_POST['txtN1'];
    $n2 = $_POST['txtN2'];
    $n3 = $_POST['txtN3'];
    $n4 = $_POST['txtN4'];
    /*Tratando erro ao digitar outro carecter alem de numero*/
    if(is_numeric($n1) && is_numeric($n2) && is_numeric($n3) && is_numeric($n4))
    {
       $resultado = media($n1,$n2,$n3,$n4);
    }else
    {
        $resultado = NON_NUMERIC;
      
    }
    
    if($n1 == "" || $n2 =="" || $n3 == "" || $n4 == "")
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
        <link rel="stylesheet" type="text/css" href="CSS/style2.css">
    </head>
    
    <body>
        <div id="linhaSup">
            <div id="menu_caixa">
                <div id="menu">
                    <div id="submenu">
                         <div class="submenu_itens">
                             <a href="Pagina1.php"> 
                                 Home
                             </a>
                           
                        </div>                        
                        <div class="submenu_itens">
                            <a href="Media.php">
                                Media
                            </a>
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
                             <a href="Select.php"> 
                                Par e Impar
                             </a>
                        </div>                           
                    </div>
                 </div>
            </div>
            
            <div id="calc_caixa">
                <div id="caixa_titulo">
                    <div id="auxilia1"><h2>Média</h2></div>
                </div>
                <div id="caixa_inferior">
                    <form name="frmMedia" method="post" action="Media.php">
                    <div id="linha_sup">
                        <div id="numeros">
                            Numero 1 <input type="text" name="txtN1" value="<?=$n1?>"><br><br>
                            Numero 2 <input type="text" name="txtN2" value="<?=$n2?>"><br><br>
                            Numero 3 <input type="text" name="txtN3" value="<?=$n3?>"><br><br>
                            Numero 4 <input type="text" name="txtN4" value="<?=$n4?>">                         
                        </div>

                        <div id="DivBtnCalc">
                            <input type="submit" name="btnCalc" value="Calcular">
                        </div>                    
                    </div>    

                        
                    <div id="divResultado">
                        <?php echo(@$resultado) ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>