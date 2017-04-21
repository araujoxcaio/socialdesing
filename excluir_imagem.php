<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //iniciando a sessão
    session_start();
    
    //pegando o ID do get que foi passado pela URL
    $id = $_GET["id"];
    
    //jogando os valores da tabela imagem em variáveis
    $imagem = $mysqli->query("SELECT * FROM imagem WHERE ID = '$id'");
    while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
        $imagem_id = $row["ID"];
        $imagem_nome = $row["NOME"];
        $imagem_descricao = $row["DESCRICAO"];
        $imagem_categoria = $row["CATEGORIA"];
        $imagem_url = $row["URL"];
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
            echo"<script language='javascript' type='text/javascript'>alert('Esta imagem não pertence ao seu usuário. Você só pode excluir suas imagens!');window.location.href='gportfolio.php';</script>";
        }
        
        else{
        
        //removendo a imagem do diretório   
        unlink("uploads/$imagem_url"); 
        unlink("uploads/min_$imagem_url");

        //delete no banco de dados
        $delete = $mysqli->query("DELETE FROM imagem WHERE ID = '$id'");            
        if(!$delete){
            echo "Erro no banco de dados";
        }

        echo"<script language='javascript' type='text/javascript'>alert('Imagem excluída com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
        }   
    }
 ?>
