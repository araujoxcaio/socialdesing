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
            header("Location:../index.php");
          }
      }
?>



















