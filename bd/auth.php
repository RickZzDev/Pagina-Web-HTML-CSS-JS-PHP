<?php 
    


    function autenticar($codigo){
        require_once('conexao.php');

        $conexao= conexaoMySql();
 

        $sql = "select  * from tblusuario join tblnivel where tblusuario.codinivel = tblnivel.codigo and tblusuario.codigo=".$codigo;
  

        $rodaScript = mysqli_query($conexao,$sql);

        $arrayDados = mysqli_fetch_array($rodaScript);
        echo($sql);
        
        
        $arrayPermicoes = array();
        if($arrayDados['adm_conteudo']==1){
            array_push($arrayPermicoes,"escolha2.php");
        }else{
            array_push($arrayPermicoes,"#");
        }
        if($arrayDados['adm_fale_conosco']==1){
            array_push($arrayPermicoes,"cmsFale.php");    
        }else{
            array_push($arrayPermicoes,"#");    
        }

        if($arrayDados['adm_usuario']==1){
            array_push($arrayPermicoes,"escolha.php");    
        }else{
            array_push($arrayPermicoes,"#");    

        }

        return $arrayPermicoes;

    }

?>