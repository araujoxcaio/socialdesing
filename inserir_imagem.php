<?php 
    include("interface/conexao.php");
    
    session_start();
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    
    	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
       
        $nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$categoria = $_POST['categoria'];
        $id = $_SESSION['id'];

	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

	// Tamanho máximo do arquivo (em bytes)
	$config["tamanho"] = 1024 * 1024 * 5;        

        $erro = "0";
	// Formulário postado... executa as ações
	if ($arquivo) { 
            
	    // Verifica se o mime-type do arquivo é de imagem
	    if (!preg_match("#^image\/(pjpeg|jpeg|png|gif|jpg)$#", $arquivo["type"]) || $arquivo["size"] > $config["tamanho"]) {
	        $erro = "Arquivo inválido! A imagem deve ser nas extensões jpg, jpeg, gif, png e conter no máximo 5MB.";
	    }         

	    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
	    else
	    {
	        // Pega extensão do arquivo
	        preg_match("/\.(bmp|png|gif|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

	        // Gera um nome único para a imagem
	        $imagem_nome = md5(uniqid(time())) . "." . $ext[1];

	        // Caminho de onde a imagem ficará
	        $imagem_dir = "uploads/" . $imagem_nome;

	        // Faz o upload da imagem
	        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
			$sql_code = "INSERT INTO imagem (NOME, DESCRICAO, CATEGORIA, URL, DATA_UPLOAD, ID_PESSOA) VALUES ('$nome', '$descricao', '$categoria', '$imagem_nome', NOW(), '$id')";
			if($mysqli->query($sql_code)){
				$msg = "Arquivo enviado com sucesso!";
			}
			else{
				$msg = "Falha ao enviar o arquivo: ". $mysqli->error;
                        }
                
                // Gera a miniatura
                require('interface/wideimage/lib/WideImage.php');
                $image = WideImage::load($imagem_dir);
                $image = $image->resize(750,450);
                $image->saveToFile('uploads/min_'.$imagem_nome);
                $imagem_min = 'uploads/min_'.$imagem_nome;
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
                    <h1> Inserir Imagem </h1>
                    <form action="inserir_imagem.php" method="POST" enctype="multipart/form-data">                        
                            <div class="form-group">
                                <label for="nome">Nome da imagem</label>
                                <input type="text" class="form-control" name="nome" required />
                            </div> 
                        
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input type="text" class="form-control" name="descricao" value="" required />
                            </div>  
                        
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control" name='categoria'>
									<option value='(Selecione uma categoria)' selected disabled>(Selecione uma categoria)</option>
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
									<option value='Projetos 3D'>Projetos 3D</option>
                                    <option value='Revistas'>Revistas</option>
									<option value='Outros'>Outros</option>
                                </select>

                            </div>
                            
                            <div class="form-group">
                                <label>Selecione a imagem</label>
                                <input type="file" class="form-control"  name="foto" required />
                            </div>
                            Atenção: Todos os campos são obrigatórios! <br>
                            A imagem deve ser nas extensões jpg, jpeg, gif, png e conter no máximo 5MB.<br><br>
                            <input class="btn btn-primary" type="submit" name="enviar" value="Enviar" />
                            <a href="gportfolio.php" class="btn btn-info">Voltar</a><br>		
                    </form>                    
                </div>
				<?php if($erro != "0") echo "<p>$erro</p>"; else echo "<p>$msg</p>"; ?>
				<?php if($msg != false) echo "<p><img src='$imagem_min'/></p> "; ?><br>  
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
