<?php 

function tabuada($n1,$n2)
{
    $valor1 = $n1;
    $valor2 = $n2;
    
    $arr = array();
    
    for($auxiliar = 0; $auxiliar<=$valor2; $auxiliar++)
    {
        $multi =  $valor1 * $auxiliar;
        $resultado  = $valor1 . "x" . $auxiliar . " = " .  $multi . "<br>";
        array_push($arr, $resultado);
 
    }
    
    return $arr;
}

?>