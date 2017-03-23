<?php
//em construção
    include("interface/conexao.php");
    
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    
    $sql = mysqli_query("SELECT * FROM PESSOA WHERE USERNAME = '$username' AND SENHA = '$senha' ") or die(mysqli_error());
    $row = mysqli_num_rows($sql);
    if($row > 0){
        session_start();
        
    }
    

?>

