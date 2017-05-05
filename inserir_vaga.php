<?php 
    include("interface/conexao.php");
    
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    session_start();
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    
    //verificando se a pessoa não é jurídica
    if($_SESSION["fisica_juridica"] <> 'J'){
        echo"<script language='javascript' type='text/javascript'>alert('Página disponível apenas para cadastros de pessoa jurídica.');window.location.href='index.php';</script>";
        exit;        
    }
    
    $titulo = $_POST['titulo'];  
    $descricao = $_POST['descricao'];  
    $salario = $_POST['salario'];  
    $categoria = $_POST['categoria'];  
    $localizacao = $_POST['localizacao'];
    $id_pessoa = $_SESSION['id'];
       
    if (isset($_POST['enviar'])) {          
        $sql = "INSERT INTO vaga (TITULO, DESCRICAO, SALARIO, CATEGORIA, LOCALIZACAO, DATA_VAGA, ID_PESSOA) VALUES ('$titulo', '$descricao', '$salario', '$categoria', '$localizacao', NOW(), '$id_pessoa')";
        if($mysqli->query($sql)){
            $msg = 'Vaga inserida com sucesso! Verifique suas vagas cadastradas no seu portfólio.';
        }
        else{
            $msg = 'Erro ao inserir vaga: '. $mysqli->error;
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
        
    </head>

    <body id="page-top">
        <?php include 'interface/navbar.php'; ?>
        <header>
        <div class="container">    
            <div class="row">  
                <div class="col-md-12">
                <center>
                <div class="formcadastro">  
                    <h1> Inserir Vaga </h1>
                    <form action="inserir_vaga.php" method="POST" enctype="multipart/form-data">                        
                            <div class="form-group">
                                <label for="titulo">Título da vaga</label>
                                <input type="text" class="form-control" name="titulo" required />
                            </div> 
                        
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class='form-control' name='descricao'></textarea>
                            </div>
                        
                            <div class="form-group">
                                <label for="salario">Salário</label>
                                <input type="text" class="form-control" name="salario" value="" />
                            </div>  
                        
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control" name='categoria'>
									<option value='(Selecione uma categoria)' selected disabled>(Selecione uma categoria)</option>
									<option value='Administração de empresas'>Administração de empresas</option>
									<option value='Analista'>Analista</option>
									<option value='Comunicação'>Comunicação</option>
									<option value='Desenvolvedor Web'>Desenvolvedor Web</option>
									<option value='Design'>Design</option>
									<option value='Estágios'>Estágios</option>
									<option value='Informática/T.I.'>Informática/T.I.</option>
                                    <option value='Marketing Digital'>Marketing Digital</option>                               
                                    <option value='Vendas'>Vendas</option>                                    
                                    <option value='Telecomunicações'>Telecomunicações</option>
									<option value='Outros'>Outros</option>
                                </select>

                            </div>
                            
                            <div class="form-group">
                                <label for="localizacao">Localização</label>
                                <input type="text" class="form-control"  name="localizacao" />
                            </div>                        
                            
                            
                            <input class="btn btn-primary" type="submit" name="enviar" value="Enviar" />
                            <a href="gportfolio.php" class="btn btn-info">Voltar</a><br>		
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
