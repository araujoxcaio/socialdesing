<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //pegando o ID do get que foi passado pela URL
    $id = $_GET["id"];  
    
    //jogando os valores da tabela imagem em variaveis
    $imagem = $mysqli->query("SELECT * FROM imagem WHERE ID = '$id'");
    while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
        $imagem_id = $row["ID"];
        $imagem_nome = $row["NOME"];
        $imagem_descricao = $row["DESCRICAO"];
        $imagem_categoria = $row["CATEGORIA"];
        $imagem_destaque = $row["DESTAQUE"];
        $imagem_url = $row["URL"];
        $data_upload = $row["DATA_UPLOAD"];
        $id_pessoa = $row["ID_PESSOA"];
    }    
    
    $pessoa = $mysqli->query("SELECT * FROM pessoa WHERE ID = '$id_pessoa'");
    while ($row = $pessoa->fetch_array(MYSQLI_ASSOC)){
        $pessoa_nome = $row["NOME"];
        $pessoa_id = $row["ID"];
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
                                    
                            <div class="col-md-6">
                                
                                <?php echo "
                                    
                                <center>
                                    <h1>$imagem_nome </h1> <br>
                                </center>
                                
                                <h4><b>Descrição:</b> $imagem_descricao</h4>
                                <h4><b>Categoria:</b> $imagem_categoria</h4>                           
                                <h4><b>Enviada por:</b> $pessoa_nome <a href='portfolio.php?id=$id_pessoa'>(ver perfil)</a></h4> 
                                <h4><b>Enviada em:</b> "; echo date('d/m/Y', strtotime($data_upload)); echo "</h4>
                                
                                ";?>  
                                
                            </div>
                               
                            <div class="col-md-6">
                                
                                <?php echo " 
                                <center><br><a href='uploads/$imagem_url''><img class='img-responsive' src='uploads/min_$imagem_url'></a>
                                    </center> 
                                ";?>
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
