<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //verificando o ID que é passado pela URL através do GET
    $id = $_GET["id"];
    
    //removendo a imagem do diretório
    $imagem = $mysqli->query("SELECT URL FROM IMAGEM WHERE ID = '$id'");   
    while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
        $url = $row["URL"];        
    }        
    unlink("uploads/$url"); unlink("uploads/min_$url");

    //delete no banco de dados
    $delete = $mysqli->query("DELETE FROM IMAGEM WHERE ID = '$id'");            
    if(!$delete){
        echo "Erro no banco de dados";
    }
    
    echo"<script language='javascript' type='text/javascript'>alert('Imagem excluída com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
    
 ?>
