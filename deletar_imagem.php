<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    $id = $_GET["id"]; 

    //delete no banco de dados
    $delete = $mysqli->query("DELETE FROM IMAGEM WHERE ID = '$id'");            
    if(!$delete){
        echo "Erro no banco de dados";
    }
    echo"<script language='javascript' type='text/javascript'>alert('Imagem excluída com sucesso!');window.location.href='gportfolio.php';</script>";

    
 ?>
