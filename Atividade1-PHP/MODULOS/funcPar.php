<?php

function par($numero1,$numero2)
{
    $aux = (int) 0;
    
    $n1 = $numero1;
    $n2 = $numero2;
    $contador = (int) 0;
    $arrayPar = array();
    for($aux = $n1; $aux <= $n2; $aux++)
    {
        if($aux % 2 ==0)
        {
             array_push($arrayPar, $aux . "<br>");
            
            $contador ++;
          
        }
        else
        {
               
        }
        
        
    }
    
    
    array_push($arrayPar, $contador);
    return ($arrayPar) ;
}

?>