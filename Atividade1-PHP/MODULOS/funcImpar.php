<?php

function impar($numero1,$numero2)
{
    $aux = (int) 0;
    
    $n1 = $numero1;
    $n2 = $numero2;
    $contador = (int) 0 ;
    $arrayImpar = array();
    for($aux = $n1; $aux <= $n2; $aux++)
    {
        if($aux % 2 > 0)
        {
             array_push($arrayImpar, $aux . "<br>");
            $contador++;
        }
        else
        {
               
        }
        
        
    }
    
    array_push($arrayImpar, $contador);
    return $arrayImpar;
}

?>