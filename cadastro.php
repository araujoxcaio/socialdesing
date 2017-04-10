<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    $msg = '';
    $fj = $_POST['tipo'];
    
    if($fj == 'F'){
        $cpf_cnpj = $_POST['cpf'];  
        $email = $_POST['f_email'];
        $senha = md5($_POST['f_senha']);  
        $entrar = $_POST['f_submit'];
    }
    if($fj == 'J'){
        $cpf_cnpj = $_POST['cnpj'];  
        $email = $_POST['j_email'];
        $senha = md5($_POST['j_senha']);  
        $entrar = $_POST['j_submit'];
    }

    if (isset($entrar)) {        
        //verificando se já existe o e-mail ou o CPF/CNPJ cadastrado no banco
        $verifica = $mysqli->query("SELECT * FROM PESSOA WHERE CPF_CNPJ = '$cpf_cnpj'");
        $verifica2 = $mysqli->query("SELECT * FROM PESSOA WHERE EMAIL = '$email'");
        if (mysqli_num_rows($verifica2)>0){
            $msg = 'Erro: Este e-mail já está cadastrado em nossa base de dados.';
        }        
        elseif (mysqli_num_rows($verifica)>0){
            $msg = 'Erro: Este CPF/CNPJ já está cadastrado em nossa base de dados.';
        }  
        
        //verificando se todos os campos estão preenchidos
        elseif($cpf_cnpj == '' || $email == '' || $senha == ''){
            $msg = "Por favor, preencha todos os campos.";
        } 
        
        //caso esteja tudo ok, insere os dados no banco
        else{        
            $sql = "INSERT INTO PESSOA (CPF_CNPJ, FISICA_JURIDICA, EMAIL, SENHA, DATA_CADASTRO) VALUES ('$cpf_cnpj', '$fj', '$email', '$senha', NOW())";
            if($mysqli->query($sql)){
                $msg = 'Usuário cadastrado com sucesso! Por favor, efetue login.';
            }
            else{
                $msg = 'Erro ao cadastrar o usuário: '. $mysqli->error;
            }
        }
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
        function alterna(tipo) {

                if (tipo == 'F') {
                document.getElementById("fisica").style.display = "block";
                document.getElementById("juridica").style.display = "none";
                } else {
                document.getElementById("fisica").style.display = "none";
                document.getElementById("juridica").style.display = "block";
                }

        }
        
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
                    <h1> Cadastre-se! </h1>
                    <form action="cadastro.php" method="POST" name="formcadastro">
                        <input type="radio" name="tipo" value="F" onclick="alterna(this.value);" /> Pessoa Física 
                        <input type="radio" name="tipo" value="J" onclick="alterna(this.value);" /> Pessoa Jurídica<br><br>
                        
                        <div id="fisica" style="display:none;">
                            <div class="form-group">
                                <label for="CPF">CPF</label>
                                <input type="text" class="form-control" name="cpf" placeholder="000.000.000-00" value="" OnKeyPress="formatar('###.###.###-##', this)" maxlength="14" />
                            </div>  
                            <div class="form-group">
                                <label for="Email">E-mail</label>
                                <input type="email" class="form-control" name="f_email" placeholder="user@domain.com" value="" />
                            </div>                        
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" class="form-control" name="f_senha" placeholder="Digite sua senha com no mínimo 6 caracteres" value="" minlength="6" />
                            </div>
							Todos os campos são obrigatórios!<br><br>
                            <input class="btn btn-primary" type="submit" name="f_submit" value="Cadastrar" />
                            <a href="index.php" class="btn btn-info">Voltar</a>
                        </div>
                        
                        <div id="juridica" style="display:none;">
                            <div class="form-group">
                                <label for="CNPJ">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" placeholder="00.000.000/0000-00" value="" OnKeyPress="formatar('##.###.###/####-##', this)" maxlength="18" />
                            </div>  
                            <div class="form-group">
                                <label for="Email">E-mail</label>
                                <input type="email" class="form-control" name="j_email" placeholder="user@domain.com" value="" />
                            </div>                        
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" class="form-control" name="j_senha" placeholder="Digite sua senha com no mínimo 6 caracteres" value="" minlength="6" />
                            </div>
                            Todos os campos são obrigatórios!<br><br>
                            <input class="btn btn-primary" type="submit" name="j_submit" value="Cadastrar" />
                            <a href="index.php" class="btn btn-info">Voltar</a>
                        </div>
                    </form>                    
                </div><?php echo $msg ?>
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
