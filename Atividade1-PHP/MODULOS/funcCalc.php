<?php 

function calcular($n1,$n2,$op)
{
    $valor1 = (float) $n1;
    $valor2 = (float) $n2;
    $operacao = (String) $op;
    
    global $chkSomar;
    global $chkSubtrair;
    global $chkMultiplicar;
    global $chkDividir;
    
    
    if($operacao == "Somar")
    {
        $resultado = $valor1 + $valor2;
        $chkSomar = "checked";
    }
        
        
    if($operacao == "Subtrair")
    {
        $resultado = $valor1 - $valor2;
        $chkSubtrair = "checked";        
    }

    if($operacao == "Dividir")
    {
        $resultado = $valor1 / $valor2;
        $chkDividir = "checked";       
    }

    if($operacao == "Multiplicar")
    {
        $resultado = $valor1 * $valor2;
        $chkMultiplicar = "checked";   
    }

    
    return round($resultado,2);
}

?>