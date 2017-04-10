<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    $id = $_GET["id"];  
    
    $vaga = $mysqli->query("SELECT * FROM VAGA WHERE ID = '$id'");
    while ($row = $vaga->fetch_array(MYSQLI_ASSOC)){
        $vaga_id = $row["ID"];
        $vaga_titulo = $row["TITULO"];
        $vaga_descricao = $row["DESCRICAO"];
        $vaga_salario = $row["SALARIO"];
        $vaga_categoria = $row["CATEGORIA"];
        $vaga_localizacao = $row["LOCALIZACAO"];
        $data_vaga = $row["DATA_VAGA"];  
        $id_pessoa = $row["ID_PESSOA"];  
    }
    
    $pessoa = $mysqli->query("SELECT * FROM PESSOA WHERE ID = '$id_pessoa'");
    while ($row = $pessoa->fetch_array(MYSQLI_ASSOC)){
        $pessoa_nome = $row["NOME"];
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
                                    
                            <div class="col-md-12">
                                
                                <?php echo "
                                    
                                <center>
                                    <h1>Vaga: $vaga_titulo </h1> <br>
                                </center>
                                
                                <h4><b>Descrição:</b> $vaga_descricao</h4>
                                <h4><b>Salário:</b> $vaga_salario</h4>
                                <h4><b>Categoria:</b> $vaga_categoria</h4>
                                <h4><b>Localização:</b> $vaga_localizacao</h4>
                                <h4><b>Empresa:</b> $pessoa_nome</h4>
                                <h4><b>Data de publicação: </b>"; echo date('d/m/Y', strtotime($data_vaga)); echo "</h4><br><br>                              
                                
                                ";?>  
                                
                                <?php
                                    //verificando se a pessoa é física, para poder se cadastrar
                                    if($_SESSION["fisica_juridica"] == 'F'){
                                        echo "
                                            <center><a title='Ao clicar no botão, o Social Design irá enviar um e-mail com seus dados de perfil para a empresa que publicou esta vaga.' href='gportfolio.php' class='btn btn-success'>Candidatar-se a vaga</a></center>
                                        ";
                                    }
                                ?>
                                
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
