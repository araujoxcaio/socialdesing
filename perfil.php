<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

    //iniciando a sessão
    session_start();
	
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    
    //jogando os valores da sessão em variáveis
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $sobre = $_SESSION['sobre'];
    $cpf_cnpj = $_SESSION['cpf_cnpj'];
    $fisica_juridica = $_SESSION['fisica_juridica'];
    $telefone = $_SESSION['telefone'];
    $data_cadastro = $_SESSION['data_cadastro'];
    
    //verificando se a pessoa é física ou jurídica
    if($fisica_juridica == 'F'){
        $post_cpf = $_POST['cpf'];  
        $post_email = $_POST['f_email'];
        $post_nome = $_POST['f_nome'];
        $post_sobre = $_POST['f_sobre'];
        $post_senha = md5($_POST['f_senha']);  
        $post_telefone = $_POST['f_telefone'];  
        $post_salvar = $_POST['f_submit'];
    }
    if($fisica_juridica == 'J'){
        $post_cpf = $_POST['cnpj'];  
        $post_email = $_POST['j_email'];
        $post_nome = $_POST['j_nome'];
        $post_sobre = $_POST['j_sobre'];
        $post_senha = md5($_POST['j_senha']);  
        $post_telefone = $_POST['j_telefone'];  
        $post_salvar = $_POST['j_submit'];
    }
    
    //verificando se o botão salvar foi acionado
    if(isset($post_salvar)){
        //update no banco de dados
        $update = $mysqli->query("UPDATE PESSOA SET NOME = '$post_nome', TELEFONE = '$post_telefone', SENHA = '$post_senha', SOBRE = '$post_sobre' WHERE ID = '$id'");            
        if(!$update){
            $msg = "Erro ao gravar os dados no banco de dados ";
        }
        $msg = "Dados alterados com sucesso!<br><br>";
        
        //atualizando os valores da sessão e suas variáveis
        if($fisica_juridica == 'F'){
            $_SESSION['nome'] = $_POST['f_nome'];
            $_SESSION['telefone'] = $_POST['f_telefone'];            
            $_SESSION['sobre'] = $_POST['f_sobre'];            
        }        
        if($fisica_juridica == 'J'){
            $_SESSION['nome'] = $_POST['j_nome'];
            $_SESSION['telefone'] = $_POST['j_telefone'];  
            $_SESSION['sobre'] = $_POST['j_sobre'];  
        }        
        $nome = $_SESSION['nome'];
        $telefone = $_SESSION['telefone'];
        $sobre = $_SESSION['sobre'];
        
    }
	
	
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
                            
                        echo "
                            <form action='perfil.php' method='POST'>	

                                <div class='form-group'>
                                        <label for='CPF'>CPF</label>
                                        <input type='text' class='form-control' name='cpf' value='$cpf_cnpj' disabled />
                                </div>  

                                <div class='form-group'>
                                        <label for='Email'>E-mail</label>
                                        <input type='email' class='form-control' name='f_email' value='$email' disabled />
                                </div> 

                                <div class='form-group'>
                                        <label for='nome'>Nome completo</label>
                                        <input type='text' class='form-control' name='f_nome' value='$nome' />
                                </div> 	

                                <div class='form-group'>
                                        <label for='senha'>Senha</label>
                                        <input type='password' class='form-control' name='f_senha' value='' required />
                                </div>

                                <div class='form-group'>
                                        <label for='telefone'>Telefone</label>
                                        <input type='text' class='form-control' name='f_telefone' OnKeyPress=\"formatar('## ####-#####', this)\" value='$telefone' maxlength='13' />
                                </div>
                                
                                <div class='form-group'>
                                        <label for='sobre'>Sobre</label>
                                        <textarea class='form-control' name='f_sobre' />$sobre</textarea>
                                </div><br>	
                                
                                $msg

                                <input class='btn btn-primary' type='submit' name='f_submit' value='Salvar Alterações' />

                            </form>        
                        ";
                        } ?>

			<?php if($_SESSION['fisica_juridica'] == 'J'){
                            
                        echo "
                            <form action='perfil.php' method='POST'>	

                                <div class='form-group'>
                                        <label for='CNPJ'>CNPJ</label>
                                        <input type='text' class='form-control' name='CNPJ' value='$cpf_cnpj' disabled />
                                </div>  

                                <div class='form-group'>
                                        <label for='Email'>E-mail</label>
                                        <input type='email' class='form-control' name='j_email' value='$email' disabled />
                                </div> 

                                <div class='form-group'>
                                        <label for='nome'>Nome completo</label>
                                        <input type='text' class='form-control' name='j_nome' value='$nome' />
                                </div> 	

                                <div class='form-group'>
                                        <label for='senha'>Senha</label>
                                        <input type='password' class='form-control' name='j_senha' value='' required />
                                </div>

                                <div class='form-group'>
                                        <label for='telefone'>Telefone</label>
                                        <input type='text' class='form-control' name='j_telefone' OnKeyPress=\"formatar('## ####-#####', this)\" value='$telefone' maxlength='13' />
                                </div>	
                                
                                <div class='form-group'>
                                        <label for='sobre'>Sobre</label>
                                        <textarea class='form-control' name='j_sobre' value='$sobre' /></textarea>
                                </div><br>
                                
                                $msg

                                <input class='btn btn-primary' type='submit' name='j_submit' value='Salvar Alterações' />

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
