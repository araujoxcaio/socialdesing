<?php

    include("interface/conexao.php");
    $connect = mysql_connect('localhost','root','');
    $db = mysql_select_db('u619293682_sodes');
	
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

    session_start();
	
	//verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
	
	$msg = '';
	
	
?>

<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Social Design</title>

        <!-- Bootstrap Core CSS -->
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="lib/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="lib/device-mockups/device-mockups.min.css">

        <!-- Theme CSS -->
        <link href="css/socialdesign.css" rel="stylesheet">

		<script>       
        //máscaras
        function formatar(mascara, documento){
        var i = documento.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(i);

        if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
        }
        }       
        </script>
    </head>

    <body id="page-top">
        <?php include 'interface/navbar.php'; ?>
        <header>
        <div class="container">    
            <div class="row">  
                <div class="col-md-12">
                <center>
                <div class="formcadastro">  
                    <h1> Editar Perfil </h1>
					<?php if($_SESSION['fisica_juridica'] == 'F'){
                            $email = $_SESSION['email'];
							$senha = $_SESSION['password'];
							$id = $_SESSION['id'];
							$nome = $_SESSION['nome'];
							$cpf_cnpj = $_SESSION['cpf_cnpj'];
							$fisica_juridica = $_SESSION['fisica_juridica'];
							$telefone = $_SESSION['telefone'];
							$data_cadastro = $_SESSION['data_cadastro'];
                            echo "
							<form action='perfil.php' method='POST' name='formcadastro'>	
							
								<div class='form-group'>
									<label for='CPF'>CPF</label>
									<input type='text' class='form-control' name='cpf_cnpj' value='$cpf_cnpj' disabled />
								</div>  
								
								<div class='form-group'>
									<label for='Email'>E-mail</label>
									<input type='email' class='form-control' name='email' value='$email' disabled />
								</div> 

								<div class='form-group'>
									<label for='nome'>Nome completo</label>
									<input type='text' class='form-control' name='nome' value='$nome' />
								</div> 	
								
								<div class='form-group'>
									<label for='senha'>Senha</label>
									<input type='text' class='form-control' name='senha' value='' required />
								</div>

								<div class='form-group'>
									<label for='telefone'>Telefone</label>
									<input type='text' class='form-control' name='telefone' OnKeyPress='formatar('##-#####-####', this)' value='$telefone' />
								</div><br>									
								
								<input class='btn btn-primary' type='submit' name='f_submit' value='Salvar Alterações' />
								<input class='btn btn-danger' type='submit' name='excluir' value='Excluir Perfil' /><br>

							</form>        
							";
					} ?>      

					<?php if($_SESSION['fisica_juridica'] == 'J'){
                            $email = $_SESSION['email'];
							$senha = $_SESSION['password'];
							$id = $_SESSION['id'];
							$nome = $_SESSION['nome'];
							$cpf_cnpj = $_SESSION['cpf_cnpj'];
							$fisica_juridica = $_SESSION['fisica_juridica'];
							$telefone = $_SESSION['telefone'];
							$data_cadastro = $_SESSION['data_cadastro'];
                            echo "
							<form action='perfil.php' method='POST' name='formcadastro'>	
							
								<div class='form-group'>
									<label for='CNPJ'>CNPJ</label>
									<input type='text' class='form-control' name='cpf_cnpj' value='$cpf_cnpj' disabled />
								</div>  
								
								<div class='form-group'>
									<label for='Email'>E-mail</label>
									<input type='email' class='form-control' name='email' value='$email' disabled />
								</div> 

								<div class='form-group'>
									<label for='nome'>Nome completo</label>
									<input type='text' class='form-control' name='nome' value='$nome' />
								</div> 	
								
								<div class='form-group'>
									<label for='senha'>Senha</label>
									<input type='text' class='form-control' name='senha' value='' required />
								</div>

								<div class='form-group'>
									<label for='telefone'>Telefone</label>
									<input type='text' class='form-control' name='telefone' OnKeyPress='formatar('##-#####-####', this)' value='$telefone' />
								</div><br>									
								
								<input class='btn btn-primary' type='submit' name='f_submit' value='Salvar Alterações' />
								<input class='btn btn-danger' type='submit' name='excluir' value='Excluir Perfil' /><br>

							</form>        
							";
					} ?> 					
                </div>
                </center>        
                </div>
            </div>
        </div>
        </header>
        <?php include 'interface/comunidade.php';
        include 'interface/footer.php'; ?>

        <!-- jQuery -->
        <script src="lib/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/new-age.min.js"></script>
    </body>

    </html>
