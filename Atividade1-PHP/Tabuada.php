<?php

/*Chamando a função*/
require_once('MODULOS/funcTabu.php');


$n1 = "";
$n2 = "";
$resultado = "Esperando cálculo";


const ERROR_EMPTY = "Favor Digitar todos os campos";
const NON_NUMERIC = "Favor digitar apenas numeros";

if(isset($_POST['btnCalc'])){
    
    
  
    $n1 = $_POST["txtN1"];
    $n2 = $_POST["txtN2"];
    
    
        /*Tratando erro ao digitar outro carecter alem de numero*/
    if(is_numeric($n1) && is_numeric($n2))
    {
              if($n1 == 0)
              {
                 $resultado = "Não existe tabuada por zero";
             }else{
                  $resultado = tabuada ($n1, $n2); 
              }
       
            
    }else {
            if(!is_numeric($n1) || !is_numeric($n2))
                $resultado = NON_NUMERIC;
            if($n1 == "" || $n2 =="")
            {
                $resultado = ERROR_EMPTY;
            }
    }
    

    

    
   
}

?>

<html>
    <head>
        <title>
            Pagina 1
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/style3.css">
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
                    <div id="auxilia1"><h2>Calculadora</h2></div>
                </div>
                <div id="caixa_inferior">
                    <form name="frmCalc" method="post" action="Tabuada.php">
                    <div id="linha_sup">
                        <div id="numeros">
                            Numero 1 <input type="text" name="txtN1" value="<?=$n1?>"><br><br>
                            Numero 2 <input type="text" name="txtN2" value="<?=$n2?>"><br><br>


                        </div>

                        <div id="DivBtnCalc">
                            <input type="submit" name="btnCalc" value="Calcular">
                        </div>                    
                    </div>    

                        
                    <div id="divResultado">
                        <?php var_dump($resultado)?>
                    </div>
                    </form>
                </div>
            </div>        
        </div>
    </body>
</html>