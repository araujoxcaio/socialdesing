<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //verificando o ID que é passado pela URL através do GET
    $id = $_GET["id"];

    //delete no banco de dados
    $delete = $mysqli->query("DELETE FROM VAGA WHERE ID = '$id'");            
    if(!$delete){
        echo "Erro no banco de dados: ". $mysqli->error;
    }
    
    echo"<script language='javascript' type='text/javascript'>alert('Vaga excluída com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
    
 ?>
