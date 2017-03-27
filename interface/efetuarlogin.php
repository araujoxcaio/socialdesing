<?php 

    session_start();
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $entrar = $_POST['entrar'];

    $connect = mysql_connect('localhost','root','');
    $db = mysql_select_db('u619293682_sodes');
    
      if (isset($entrar)) {

        $verifica = mysql_query("SELECT * FROM PESSOA WHERE EMAIL = '$email' AND SENHA = '$password'") or die("ERRO BD");
          if (mysql_num_rows($verifica)<=0){
            echo"<script language='javascript' type='text/javascript'>alert('Login e/ou Senha incorretos. Tente novamente');window.location.href='../login.php';</script>";
            die();
          }else{
            $_SESSION['email'] = $email;			
            $_SESSION['senha'] = $password;
			
			//pegando os outros dados e jogando na sessão
			$result = mysql_query("SELECT ID, NOME, CPF_CNPJ, FISICA_JURIDICA, TELEFONE, DATA_CADASTRO FROM PESSOA WHERE EMAIL = '$email' AND SENHA = '$password'");
			while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
				$id = $row["ID"];
				$nome = $row["NOME"];
				$cpf_cnpj = $row["CPF_CNPJ"];
				$fisica_juridica = $row["FISICA_JURIDICA"];
				$telefone = $row["TELEFONE"];
				$data_cadastro = $row["DATA_CADASTRO"];
			}
			
			$_SESSION['id'] = $id;
			$_SESSION['nome'] = $nome;
			$_SESSION['cpf_cnpj'] = $cpf_cnpj;
			$_SESSION['fisica_juridica'] = $fisica_juridica;
			$_SESSION['telefone'] = $telefone;
			$_SESSION['data_cadastro'] = $data_cadastro;		
			
			header("Location:../index.php");
          }
      }
?>



















