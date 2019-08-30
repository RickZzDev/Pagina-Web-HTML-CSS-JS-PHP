
<?php  

function media($numero1,$numero2,$numero3,$numero4)
{
    $valor1 = (float) $numero1;
    $valor2 = (float) $numero2;
    $valor3 = (float) $numero3;
    $valor4 = (float) $numero4;
    
    $result = $valor1 + $valor2 + $valor3 + $valor4;
    $resultado = $result / 4;
    
    
    return round($resultado,2);
}


?>