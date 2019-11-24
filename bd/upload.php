<?php

    session_start();
    // var_dump($_FILES['flefoto']);
    if ($_FILES['flefoto']['size'] > 0 && $_FILES['flefoto']['type'] != "")
    {
        

        //Guarda o tamanho do arquivo a ser upado para o servidor
        $arquivo_size = $_FILES['flefoto']['size'];
       
        //Converte o tamanho do arquivo para Kbyte e pega somente a parte inteira da conversão (round)
        $tamanho_arquivo = round($arquivo_size/1024);

        $arquivos_permitidos = array("image/jpeg", "image/jpg", "image/png");

        //Guarda o tipo de extenção do arquivo a ser upado para o servidor
        $ext_arquivo = $_FILES['flefoto']['type'];


        //Valida o tipo de arquivo a ser upado para o servidor
        if(in_array($ext_arquivo, $arquivos_permitidos))
        {

            //Valida o tamanho maximo de arquivo que esta sendo upado
            if($tamanho_arquivo < 1000)
            {

                //Permite retornar apenas o nome do arquivo 
                //pathinfo(var, PATHINFO_FILENAME)
                $nome_arquivo = pathinfo($_FILES['flefoto']['name'], PATHINFO_FILENAME);

                //Permite retornar apenas a extensão do arquivo
                //pathinfo(var, PATHINFO_FILENAME)
                $ext = pathinfo($_FILES['flefoto']['name'], PATHINFO_EXTENSION);

                //No PHP podemos usar dois algoritmos de criptografia (MD5, SHA1, hash(tipo do algoritmo, var))

                //Estamos gerando uma chave com o nome do arquivo + uniqid(time()) que é um numero aleatorio com base em uma hh:mm:ss
                $nome_arquivo_cripty = md5(uniqid(time()).$nome_arquivo);

                $foto = $nome_arquivo_cripty.".".$ext;

                $arquivo_temp = $_FILES['flefoto']['tmp_name'];

                $diretorio = "../bd/arquivos/";

                if (move_uploaded_file($arquivo_temp, $diretorio.$foto))
                {
                    $_SESSION['previewFoto'] = $foto;
                    echo("<img src='../bd/arquivos/".$foto."'>");
                } else{
                    echo("<script> 
                            alert('Não foi possivel enviar o arquivo para o servidor');
                        </script>");
                }


            }else{
                echo("<script> 
                        alert('Tamanho do arquivo não pode ser maior do que 2Mb');
                    </script>");
            }
        }else{
            echo("<script> 
                    alert('Tipo de arquivo não pode ser upado para o servidor (arquivos permitidos: .jpg, .png, .jpeg)');
                </script>");
        }
    }else{
        echo("<script> 
                alert('Arquivo não selecionado conforme tamanho ou tipo de arquivo');
            </script>");
    }
?>