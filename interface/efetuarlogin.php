<?php 
    //include da conexão com o banco de dados
    include("conexao.php");
    
    //iniciando a sessão
    session_start();
    
    //pegando as variáveis do formulário 
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $entrar = $_POST['entrar'];     
    
    //verificando se foi clicado no botão entrar
    if (isset($entrar)) {
        $verifica = $mysqli->query("SELECT * FROM pessoa WHERE EMAIL = '$email' AND SENHA = '$password'");
        
        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
        if (mysqli_num_rows($verifica)<=0){
            echo"<script language='javascript' type='text/javascript'>alert('Login e/ou Senha incorretos. Tente novamente');window.location.href='../login.php';</script>";
            die();
        }
        
        //caso tenha encontrado os dados, prossegue... jogando os dados na sessão
        else{
            $_SESSION['email'] = $email;			
            $_SESSION['senha'] = $password;
			
            //pegando os outros dados e jogando na sessão
            $result = $mysqli->query("SELECT ID, NOME, CPF_CNPJ, FISICA_JURIDICA, TELEFONE, DATA_CADASTRO, SOBRE FROM pessoa WHERE EMAIL = '$email' AND SENHA = '$password'");
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                $id = $row["ID"];
                $nome = $row["NOME"];
                $cpf_cnpj = $row["CPF_CNPJ"];
                $fisica_juridica = $row["FISICA_JURIDICA"];
                $telefone = $row["TELEFONE"];
				$sobre = $row["SOBRE"];
                $data_cadastro = $row["DATA_CADASTRO"];
            }
			
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['cpf_cnpj'] = $cpf_cnpj;
            $_SESSION['fisica_juridica'] = $fisica_juridica;
            $_SESSION['telefone'] = $telefone;
            $_SESSION['data_cadastro'] = $data_cadastro;
            $_SESSION['sobre'] = $sobre;
			
            if($_SESSION['nome'] == ''){
                echo"<script language='javascript' type='text/javascript'>alert('Por favor, complete seu perfil.');window.location.href='../perfil.php';</script>";
            }
            else{
                header("Location:../index.php");
            }
            
          }
      }
?>
