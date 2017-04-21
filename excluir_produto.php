<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //iniciando a sessão
    session_start();
    
    //pegando o ID do get que foi passado pela URL
    $id = $_GET["id"];
    
    //jogando os valores da tabela produto em variaveis
    $produto = $mysqli->query("SELECT * FROM produto WHERE ID = '$id'");
    while ($row = $produto->fetch_array(MYSQLI_ASSOC)){
        $produto_id = $row["ID"];
        $produto_nome = $row["NOME"];
        $produto_descricao = $row["DESCRICAO"];
        $produto_categoria = $row["CATEGORIA"];
        $imagem_vinculada_url = $row["URL_IMAGEM"];
        $produto_url = $row["URL_ARQUIVO"];
        $data_upload = $row["DATA_UPLOAD"];
        $id_pessoa = $row["ID_PESSOA"];
    } 
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    else{
        //verificando se a pessoa que está logada é a mesma que publicou a imagem
        if($_SESSION["id"] != $id_pessoa){
            echo"<script language='javascript' type='text/javascript'>alert('Este produto não pertence ao seu usuário. Você só pode excluir os seus produtos!');window.location.href='gportfolio.php';</script>";
        }
        
        else{    
            //removendo a imagem do diretório   
            unlink("uploads/$produto_url"); 
            unlink("uploads/$imagem_vinculada_url"); unlink("uploads/min_$imagem_vinculada_url");

            //delete no banco de dados
            $delete = $mysqli->query("DELETE FROM produto WHERE ID = '$id'");            
            if(!$delete){
                echo "Erro no banco de dados";
            }

            echo"<script language='javascript' type='text/javascript'>alert('Produto excluído com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
        }
    }
 ?>
