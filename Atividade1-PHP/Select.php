<?php

/*Chamando a função*/
require_once('MODULOS/funcPar.php');
require_once('MODULOS/funcImpar.php');


$teste = 50;
$n1 = 0;
$n2 = 0;
$resultado;


const ERROR_EMPTY = "Favor Digitar todos os campos";
const NON_NUMERIC = "Favor digitar apenas numeros";

if(isset($_POST['btnCalc'])){
    
    
  
    $n1 = $_POST["sltNumeros"];
    settype($n1, "int");
    
    $n2 = $_POST["sltNumeros2"];
    settype($n2, "int");
    
    
    
        /*Tratando erro ao digitar outro carecter alem de numero*/
    if(is_numeric($n1) && is_numeric($n2))
    {
        $resultado = par ($n1, $n2);
        $resultadoImpar = impar($n1,$n2);
            
    }
    
    /*Tratamento para numero incial maior que final*/
    if($n1 > $n2)
    {
         $resultado = "erro3";
        $resultadoImpar = "";
    }
    
        if($n1 == $n2)
    {
         $resultado = "E2";
        $resultadoImpar = "";
    }
    
       
    
    /*tratamento para não numerico*/
    if(!is_numeric($n1) || !is_numeric($n2))
        $resultado = NON_NUMERIC;
    
    /*Tratamento para caixa vazia*/
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
        <link rel="stylesheet" type="text/css" href="CSS/styleSelect.css">
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
                    <form name="frmCalc" method="post" action="Select.php">
                    <div id="linha_sup">
                        <div id="numeros">
                            <select name="sltNumeros">
                                <option value="">escolha um numero
                                </option>
                      
                                    
                                <?php
                                    for($inicial = 0; $inicial<=500;$inicial++)
                                    { ?> 
                                        <option value="<?=$inicial?>"><?=$inicial?>
                                          </option>
                                   <?php  }?>
                                    
                                      
                                
                            </select><br><br>
                            
                            <select name="sltNumeros2">
                            <option value=""> Escolha um numero</option>
                            <?php
                                for($inicial2 = 100;$inicial2<=1000;$inicial2++)
                                { ?>  
                                    <option value="<?=$inicial2?>"><?=$inicial2?></option>
                                <?php }?>
                             
                            
                            </select>


                        </div>

                        <div id="DivBtnCalc">
                            <input type="submit" name="btnCalc" value="Calcular">
                        </div>                    
                    </div>    

                        <div id="SeguraResult">  
                                <div id="divResultado">
                                    <?php
                                    
                                    if(isset($_POST['btnCalc'])){



                                        /*Tratando erro ao digitar outro carecter alem de numero*/
                                    if(is_numeric($n1) && is_numeric($n2))
                                    {
                                        $resultado = par ($n1, $n2);
                                        $resultadoImpar = impar($n1,$n2);

                                    }

                                    /*Tratamento para numero incial maior que final*/
                                    if($n1 > $n2)
                                    {
                                         $resultado = "O numero inicial deve ser menor que o final";
                                        $resultadoImpar = "";
                                    }

                                        if($n1 == $n2)
                                    {
                                         $resultado = "Os numeros não podem ser iguais";
                                        $resultadoImpar = "";
                                    }



                                    /*tratamento para não numerico*/
                                    if(!is_numeric($n1) || !is_numeric($n2))
                                        $resultado = NON_NUMERIC;

                                    /*Tratamento para caixa vazia*/
                                    if($n1 == "" || $n2 =="")
                                    {
                                        $resultado = ERROR_EMPTY;
                                    }else
                                        @$numeroDePares = $resultado[ count($resultado) - 1 ];
                                        @$arraySemUltimo = array_pop($resultado);
                                        @var_dump($resultado);
                                        
                                        


                                    }


                                    ?>
                                </div>

                                <div id="resultado2">
                                    <?php
                                    if(isset($_POST['btnCalc'])){



                                        /*Tratando erro ao digitar outro carecter alem de numero*/
                                    if(is_numeric($n1) && is_numeric($n2))
                                    {
                                        $resultado = par ($n1, $n2);
                                        $resultadoImpar = impar($n1,$n2);

                                    }

                                    /*Tratamento para numero incial maior que final*/
                                    if($n1 > $n2)
                                    {
                                         $resultado = "E1";
                                        $resultadoImpar = "";
                                    }

                                        if($n1 == $n2)
                                    {
                                         $resultado = "E2";
                                        $resultadoImpar = "";
                                    }



                                    /*tratamento para não numerico*/
                                    if(!is_numeric($n1) || !is_numeric($n2))
                                        $resultado = NON_NUMERIC;

                                    /*Tratamento para caixa vazia*/
                                    if($n1 == "" || $n2 =="")
                                    {
                                        $resultado = ERROR_EMPTY;
                                    }else
                                    @$numeroDeImpares = $resultadoImpar[count($resultadoImpar) - 1];
                                    @$arraySemUltimo = array_pop($resultadoImpar);
                                    @var_dump($resultadoImpar);
                                        
                                        


                                }
                                    
                                ?>
                                </div>    
                                
                        </div>
                        <div id="contadorPar">
                            <?php  echo ("Numero de pares: " . @$numeroDePares)?>
                        </div>
                        <div id="contadorImpar">
                            <?php  echo ("Numero de pares: " .@$numeroDeImpares)?>
                        </div>                        
                    </form>
 
                </div>
                

            </div>        
        </div>
    </body>
</html>