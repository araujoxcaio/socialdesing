<?php 
    include("interface/conexao.php");
    
    session_start();
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    
    $pessoa_id = $_SESSION['id'];
    
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
            
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
                <div class="header-content">
                        <div class="container">
                           <div class="apresentation">                       

                            <center><h1> Gerenciar Portfólio </h1><br>
                    
                            <a href="inserir_imagem.php" class="btn btn-outline btn-xl">Inserir nova Imagem</a>
                            <a href="inserir_produto.php" class="btn btn-outline btn-xl">Inserir novo Produto</a>
                    
                            </center><br>
                    
                            <div class="col-md-6">
                                <h2 align="center"> Últimas imagens enviadas </h2><br>
                                
                                <?php 

                                $imagem = $mysqli->query("SELECT * FROM IMAGEM WHERE ID_PESSOA = '$pessoa_id'");
                                while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
                                    $imagem_id = $row["ID"];
                                    $imagem_nome = $row["NOME"];
                                    $imagem_descricao = $row["DESCRICAO"];
                                    $imagem_categoria = $row["CATEGORIA"];
                                    $imagem_url = $row["URL"];
                                    $data_upload = $row["DATA_UPLOAD"];

                                    echo 
                                    "<div class='col-md-4 portfolio-item'>
                                    
                                    <center><h4>$imagem_nome</h4>
                                    <a href='#'><img src='uploads/min_$imagem_url' width='150px' height='100px'></a><br><br>                                   
                                    <a href='editar_imagem.php?id=$imagem_id' class='btn btn-outline'>Editar</a></center>
                                    
                                    </div>";
                                }

                                ?> 
                                
                            </div>
                            
                            <div class="col-md-6">
                                <h2 align="center"> Últimos produtos enviados </h2><br>
                                
                                <?php                                

                                ?> 
                            </div>
                    
                        </div>       
                    </div>
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
