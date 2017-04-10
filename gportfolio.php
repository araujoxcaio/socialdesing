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
        
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        </style>
        
    </head>

    <body id="page-top">
        <?php include 'interface/navbar.php'; ?>
        <header>
        <div class="container">    
            <div class="row">  
                <div class="header-content">
                        <div class="container">
                           <div class="apresentation">                       

                            <center><h1> Gerenciar Portfólio <a href="<?php echo "portfolio.php?id=$pessoa_id"?>">(ver)</a></h1> <br>
                    
                            <a href="inserir_imagem.php" class="btn btn-outline btn-xl">Inserir nova Imagem</a>
                            <a href="inserir_produto.php" class="btn btn-outline btn-xl">Inserir novo Produto</a>
                            <?php if($_SESSION["fisica_juridica"] == 'J'){ echo"<a href='inserir_vaga.php' class='btn btn-outline btn-xl'>Inserir Vaga</a>"; } ?>
                    
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
                                    <a href='editar_imagem.php?id=$imagem_id' class='btn btn-outline'>Editar</a></center><br>
                                    
                                    </div>";
                                }

                                ?> 
                                
                            </div>
                            
                            <div class="col-md-6" style="border-left:1px solid #fff">
                                <h2 align="center"> Últimos produtos enviados </h2><br>
                                
                                <?php 

                                $produto = $mysqli->query("SELECT * FROM PRODUTO WHERE ID_PESSOA = '$pessoa_id'");
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
                                    
                                    <center><h4>$produto_nome</h4>
                                    <a href='#'><img src='uploads/min_$imagem_vinculada_url' width='150px' height='100px'></a><br><br>                                   
                                    <a href='editar_produto.php?id=$produto_id' class='btn btn-outline'>Editar</a></center><br>
                                    
                                    </div>";
                                }

                                ?>
                                
                            </div><br>
                            
                            <div class="col-md-12" style="border-top: 1px solid #fff">
                                <h2 align='center'> Vagas publicadas </h2><br>
                                
                                <table> 
                                    <tr><center>
                                        <th><center>Título</center></th>                                    
                                        <th><center>Salario</center></th>
                                        <th><center>Categoria</center></th>
                                        <th><center>Localizacao</center></th>
                                        <th><center>Data de publicação</center></th>
                                        </center></tr>
                            <?php if($_SESSION["fisica_juridica"] == 'J'){ 
                                
                            $vaga = $mysqli->query("SELECT * FROM VAGA WHERE ID_PESSOA = '$pessoa_id'");
                                while ($row = $vaga->fetch_array(MYSQLI_ASSOC)){
                                    $vaga_id = $row["ID"];
                                    $vaga_titulo = $row["TITULO"];
                                    $vaga_descricao = $row["DESCRICAO"];
                                    $vaga_salario = $row["SALARIO"];
                                    $vaga_categoria = $row["CATEGORIA"];
                                    $vaga_localizacao = $row["LOCALIZACAO"];
                                    $data_vaga = $row["DATA_VAGA"];                                    
                            
                            echo                            
                            "                             
                                <tr>
                                    <td>$vaga_titulo</td>
                                    <td>$vaga_salario</td>
                                    <td>$vaga_categoria</td>
                                    <td>$vaga_localizacao</td>
                                    <td>"; echo date('d/m/Y', strtotime($data_vaga)); echo "</td>
                                    <td><a href='vaga.php?id=$vaga_id'>Ver</a></td>
                                    <td><a href='editar_vaga.php?id=$vaga_id'>Editar</td>
                                    <td><a href='excluir_vaga.php?id=$vaga_id' onclick=\"return confirm('Tem certeza que deseja apagar a imagem? Esta ação não poderá ser desfeita.');\">Excluir</td>
                                </tr>
                            
                            
                            
                            ";
                                }
                            }?> 
                            </table><br><br></div>
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
