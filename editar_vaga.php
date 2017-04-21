<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    //iniciando a sessão
    session_start();
    
    //pegando o ID do get que foi passado pela URL
    $id = $_GET["id"];
    
    //jogando os valores da tabela vaga em variaveis
    $vaga = $mysqli->query("SELECT * FROM vaga WHERE ID = '$id'");
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
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    else{
        //verificando se a pessoa que está logada é a mesma que publicou a imagem
        if($_SESSION["id"] != $id_pessoa){
            echo"<script language='javascript' type='text/javascript'>alert('Esta vaga não pertence ao seu usuário. Você só pode editar as suas vagas!');window.location.href='gportfolio.php';</script>";
        }
    }         
    
    $post_titulo = $_POST['vaga_titulo'];
    $post_descricao = $_POST['vaga_descricao'];
    $post_salario = $_POST['vaga_salario'];
    $post_categoria = $_POST['vaga_categoria'];
    $post_localizacao = $_POST['vaga_localizacao'];
    $post_editar = $_POST['editar'];
        
    //verificando se o botão salvar foi acionado
    if(isset($post_editar)){
        //update no banco de dados
        $update = $mysqli->query("UPDATE vaga SET TITULO = '$post_titulo', DESCRICAO = '$post_descricao', SALARIO = '$post_salario', CATEGORIA = '$post_categoria', LOCALIZACAO = '$post_localizacao' WHERE ID = '$id'");
        if(!$update){
            $msg = "Erro ao gravar os dados no banco de dados: ". $mysqli->error;
        }
        $msg = "Vaga alterada com sucesso!<br><br>";
        
        $vaga_titulo = $post_titulo;
        $vaga_descricao = $post_descricao;
        $vaga_salario = $post_salario; 
        $vaga_categoria = $post_categoria; 
        $vaga_localizacao = $post_localizacao; 
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
                                    <h1>Editar vaga: $vaga_titulo </h1> 
                                </center>

                                <form action='editar_vaga.php?id=$id' method='POST'>	

                                    <div class='form-group'>
                                        <label for='Titulo'>Título</label>
                                        <input type='text' class='form-control' name='vaga_titulo' value='$vaga_titulo' required/>
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='descricao'>Descrição</label>
                                        <textarea class='form-control' name='vaga_descricao' required>$vaga_descricao</textarea>
                                    </div> 
                                    
                                    <div class='form-group'>
                                        <label for='salario'>Salário</label>
                                        <input type='text' class='form-control' name='vaga_salario' value='$vaga_salario' />
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='Nome'>Categoria</label>
                                        <select class='form-control' name='vaga_categoria'>
                                            <option value='$vaga_categoria' selected>$vaga_categoria</option>
                                            <option value='Arte digital'>Arte digital</option>
                                            <option value='Arte tradicional'>Arte tradicional</option>
                                            <option value='Artesanato'>Artesanato</option>
                                            <option value='Cartoons & Comics'>Cartoons & Comics</option>
                                            <option value='Concursos'>Concursos</option>
                                            <option value='Desenhos e Interfaces'>Desenhos e Interfaces</option>
                                            <option value='Filmes e Animações'>Filmes e Animações</option>
                                            <option value='Fotografia'>Fotografia</option>
                                            <option value='Literatura'>Literatura</option>
                                            <option value='Livros de movimento'>Livros de movimento</option>
                                            <option value='Manga e Anime'>Manga e Anime</option>
                                            <option value='Personalização'>Personalização</option>
                                            <option value='Projetos Comunitários'>Projetos Comunitários</option>
                                            <option value='Revistas'>Revistas</option>
                                        </select>
                                    </div>

                                    <div class='form-group'>
                                        <label for='localizacao'>Localização</label>
                                        <input type='text' class='form-control' name='vaga_localizacao' value='$vaga_localizacao' />
                                    </div>
                                    
                                    <input class='btn btn-success pull-left' type='submit' name='editar' value='Salvar Alterações' />
                                    
                                </form> 
                                
                                    <a href='excluir_vaga.php?id=$id' class='btn btn-danger pull-right' onclick=\"return confirm('Tem certeza que deseja apagar a imagem? Esta ação não poderá ser desfeita.');\">Apagar Vaga</a>
                                    
                                    <br><br>
                                    <center>$msg
                                    <a href='gportfolio.php' class='btn btn-info'>Voltar para portfólio</a></center>

                                
                                
                                ";?>   
                                
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
