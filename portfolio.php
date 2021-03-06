<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    $id = $_GET["id"];    
    
    $pessoa = $mysqli->query("SELECT * FROM pessoa WHERE ID = '$id'");
    while ($row = $pessoa->fetch_array(MYSQLI_ASSOC)){
        $pessoa_id = $row["ID"];
        $pessoa_nome = $row["NOME"];
        $sobre = $row["SOBRE"];
        $cpf_cnpj = $row["CPF_CNPJ"];
        $fisica_juridica = $row["FISICA_JURIDICA"];
        $telefone = $row["TELEFONE"];
        $email_pessoa = $row["EMAIL"];
        $data_cadastro = $row["DATA_CADASTRO"];
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
                <div class="header-content">
                        <div class="container">
                           <div class="apresentation"> 
                                    
                            <div class="col-md-8">
                                <center><?php echo "<h1>Portfólio: ". $pessoa_nome. "</h1>" ?></center>
                                <?php echo "<h3> CPF/CNPJ: ". $cpf_cnpj. "</h3>" ?> 
                                <?php echo "<h3> E-mail: ". $email_pessoa. "</h3>" ?> 
                                <?php echo "<h3> Telefone: ". $telefone. "</h3>" ?>
                                <?php echo "<h3> Sobre: ". $sobre. "</h3>" ?> <br>
                                <a href="#produtos" class="btn btn-outline btn-xl">Ver produtos</a>
                                <a href="#imagens" class="btn btn-outline btn-xl pull-right">Ver imagens</a>
                                     
                            </div>
       
                            <div class="col-md-4">
                                    <br>
                    <?php
                    $imagem_destaque = $mysqli->query("SELECT * FROM imagem WHERE ID_PESSOA = '$id' AND DESTAQUE = 'on'");
                    while ($row = $imagem_destaque->fetch_array(MYSQLI_ASSOC)){
                        $d_imagem_id = $row["ID"];
                        $d_imagem_nome = $row["NOME"];
                        $d_imagem_descricao = $row["DESCRICAO"];
                        $d_imagem_categoria = $row["CATEGORIA"];
                        $d_imagem_url = $row["URL"];
                        $d_data_upload = $row["DATA_UPLOAD"];                    
                    }
                    echo "<center><a href='imagem.php?id=$d_imagem_id'><img class='img-responsive' src='uploads/$d_imagem_url' width='400' alt='$d_imagem_nome'></a></center>";
                    ?>                
                                    <br>
                                    <center>Imagem em destaque<br></center>
                                    
                                    
                            </div>
      
                                </div>
                        </div>   

            </div>
        </div>
        </header>
        
            <section id="imagens" class="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-heading">
                            <h2>Imagens</h2>
                            <p class="text-muted">Estas são as imagens enviadas pelo autor</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="container">
        <!-- Projects Row -->
            <div class="row">
                <?php 
                
                    $imagem = $mysqli->query("SELECT * FROM imagem WHERE ID_PESSOA = '$id'");
                    while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
                        $imagem_id = $row["ID"];
                        $imagem_nome = $row["NOME"];
                        $imagem_descricao = $row["DESCRICAO"];
                        $imagem_categoria = $row["CATEGORIA"];
                        $imagem_url = $row["URL"];
                        $data_upload = $row["DATA_UPLOAD"];
                        
                        echo 
                        "<div class='col-md-4 portfolio-item'>
                        <a href='imagem.php?id=$imagem_id'>
                            <img src='uploads/min_$imagem_url' width='350px' height='230px'>
                        </a>
                        <h3>
                            <center><a href='imagem.php?id=$imagem_id'>$imagem_nome</a></center>
                        </h3>
                        </div>";
                    }
                    
                    
                
                ?>               

            </div>
                
            </div>
    </section>
        
        
    <section id="produtos" class="features" style="background:#eee">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-heading">
                            <h2>Produtos</h2>
                            <p class="text-muted">Estes são os produtos enviados pelo autor</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="container">
        <!-- Projects Row -->
            <div class="row">
                <?php 
                
                    $produto = $mysqli->query("SELECT * FROM produto WHERE ID_PESSOA = '$pessoa_id'");
                    while ($row = $produto->fetch_array(MYSQLI_ASSOC)){
                        $produto_id = $row["ID"];
                        $produto_nome = $row["NOME"];
                        $produto_descricao = $row["DESCRICAO"];
                        $produto_categoria = $row["CATEGORIA"];
                        $imagem_vinculada_url = $row["URL_IMAGEM"];
                        $produto_url = $row["URL_PRODUTO"];
                        $data_upload = $row["DATA_UPLOAD"];
                        
                        echo 
                        "<div class='col-md-4 portfolio-item'>
                        <a href='produto.php?id=$produto_id'>
                            <img src='uploads/min_$imagem_vinculada_url' width='350px' height='230px'>
                        </a>
                        <h3>
                            <center><a href='produto.php?id=$produto_id'>$produto_nome</a></center>
                        </h3>
                        </div>";
                    }
                    
                    
                
                ?>               

            </div>
                
            </div>
    </section>
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
