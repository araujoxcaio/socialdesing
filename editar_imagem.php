<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    
    $id = $_GET["id"]; 
    
    $post_nome = $_POST['imagem_nome'];
    $post_descricao = $_POST['imagem_descricao'];
    $post_categoria = $_POST['imagem_categoria'];
    $post_editar = $_POST['editar'];
        
    //verificando se o botão salvar foi acionado
    if(isset($post_editar)){
        //update no banco de dados
        $update = $mysqli->query("UPDATE IMAGEM SET NOME = '$post_nome', DESCRICAO = '$post_descricao', CATEGORIA = '$post_categoria' WHERE ID = '$id'");            
        if(!$update){
            $msg = "Erro ao gravar os dados no banco de dados ";
        }
        $msg = "Imagem alterada com sucesso!<br><br>";
    }   
  
    
    $imagem = $mysqli->query("SELECT * FROM IMAGEM WHERE ID = '$id'");
    while ($row = $imagem->fetch_array(MYSQLI_ASSOC)){
        $imagem_id = $row["ID"];
        $imagem_nome = $row["NOME"];
        $imagem_descricao = $row["DESCRICAO"];
        $imagem_categoria = $row["CATEGORIA"];
        $imagem_url = $row["URL"];
        $data_upload = $row["DATA_UPLOAD"];
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
           function confirma(id) {
                var apagar = confirm('Tem certeza?');
                if (apagar){
                    location.href = 'deletar_imagem.php?id='+ id;
                    }else{
                    alert('olh');
                    }    
            }
        </script>

    </head>

    <body id="page-top">
        <?php include 'interface/navbar.php'; ?>
        <header>
        <div class="container">    
            <div class="row">  
                <div class="header-content">
                        <div class="container">
                           <div class="apresentation"> 
                                    
                            <div class="col-md-7">
                                
                                <?php echo "
                                <center>
                                    <h1>Editar imagem: $imagem_nome </h1> 
                                </center>

                                <form action='editar_imagem.php?id=$id' method='POST'>	

                                    <div class='form-group'>
                                        <label for='Nome'>Nome</label>
                                        <input type='text' class='form-control' name='imagem_nome' value='$imagem_nome' />
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='Nome'>Descrição</label>
                                        <input type='text' class='form-control' name='imagem_descricao' value='$imagem_descricao' />
                                    </div> 
                                    
                                    <div class='form-group'>
                                        <label for='Nome'>Categoria</label>
                                        <select class='form-control' name='imagem_categoria'>
                                            <option value='$imagem_categoria' selected>$imagem_categoria</option>
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
                                    
                                    <input class='btn btn-success pull-left' type='submit' name='editar' value='Salvar Alterações' />
                                    
                                </form> 
                                
                                    <a href='deletar_imagem.php?id=$id' class='btn btn-danger pull-right' onclick=\"return confirm('Tem certeza que deseja apagar a imagem? Esta ação não poderá ser desfeita.');\">Apagar Imagem</a>
                                    
                                    <br><br>
                                    <center>$msg
                                    <a href='gportfolio.php' class='btn btn-info'>Voltar para portfólio</a></center>

                                
                                
                                ";?>   
                                
                            </div>
       
                            <div class="col-md-5">
                                <?php echo " 
                                <br><a href='uploads/$imagem_url''><img class='img-responsive' src='uploads/min_$imagem_url'></a>
                                <center>Enviada em: "; echo date('d/m/Y', strtotime($data_upload)); ?></center>                                
                            </div>
      
                                </div>
                        </div>   
                
                <div class="col-md-6">                
                <div class="formcadastro">  
                                    
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
