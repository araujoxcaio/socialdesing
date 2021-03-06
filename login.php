<?php  
   
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //verificando se já está logado, caso esteja, não permitirá visualizar esta página.
    session_start();    
    if(isset($_SESSION["email"])){
        header("Location: index.php");
        exit;        
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

    </head>

    <body id="page-top">
        <?php include 'interface/navbar.php'; ?>
        <header>
        <div class="container">    
            <div class="row">  
                <div class="col-md-12">
                <center>
                <div class="formcadastro">  
                    <h1> Login </h1>
                    <form class="formlogin" name="login" action="http://localhost/SocialDesign/interface/efetuarlogin.php" method="POST" accept-charset="UTF-8"><!-- ALTERAR O LINK-->
                        <div class="form-group">
                            <label for="Email">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="user@domain.com" value="" />
                        </div>                        
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="password" placeholder="Digite sua senha com no mínimo 6 caracteres" value="" minlength="6" />
                        </div>
                        <input class="btn btn-primary" type="submit" name="entrar" value="Entrar" /><br><br>
                        <a href="cadastro.php" class="btn btn-info">Criar uma conta</a>                        
                    </form>                    
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
