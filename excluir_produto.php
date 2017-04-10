<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //verificando o ID que é passado pela URL através do GET
    $id = $_GET["id"];
    
    //removendo a imagem do diretório
    $produto = $mysqli->query("SELECT * FROM PRODUTO WHERE ID = '$id'");   
    while ($row = $produto->fetch_array(MYSQLI_ASSOC)){
        $produto_url = $row["URL_ARQUIVO"];        
        $imagem_vinculada_url = $row["URL_IMAGEM"];        
    }        
    unlink("uploads/$produto_url"); 
    unlink("uploads/$imagem_vinculada_url"); unlink("uploads/min_$imagem_vinculada_url");

    //delete no banco de dados
    $delete = $mysqli->query("DELETE FROM PRODUTO WHERE ID = '$id'");            
    if(!$delete){
        echo "Erro no banco de dados";
    }
    
    echo"<script language='javascript' type='text/javascript'>alert('Produto excluído com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
    
 ?>
