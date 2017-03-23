<?php
    include("conexao.php");
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $username = $_POST['username'];
    
    $sql = "INSERT INTO PESSOA (EMAIL, USERNAME, SENHA, DATA_CADASTRO) VALUES ('$email', '$username', '$senha', NOW())";
    if($mysqli->query($sql)){
        echo "Usuário cadastrado com sucesso!";
    }
    else{
        echo "Erro ao cadastrar o usuário";
    }
?>
