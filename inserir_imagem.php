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

	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

	// Tamanho máximo do arquivo (em bytes)
	$config["tamanho"] = 5000000;        

        $erro = "0";
	// Formulário postado... executa as ações
	if ($arquivo) { 
            
	    // Verifica se o mime-type do arquivo é de imagem
	    if (!preg_match("#^image\/(pjpeg|jpeg|png|gif|jpg|svg|bmp)$#", $arquivo["type"]) || $arquivo["size"] > $config["tamanho"]) {
	        $erro = "Arquivo inválido! A imagem deve ser nas extensões jpg, jpeg, bmp, gif, png ou svg e conter no máximo 5MB.";
	    }         

	    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
	    else
	    {
	        // Pega extensão do arquivo
	        preg_match("/\.(gif|bmp|png|jpg|jpeg|svg){1}$/i", $arquivo["name"], $ext);

	        // Gera um nome único para a imagem
	        $imagem_nome = md5(uniqid(time())) . "." . $ext[1];

	        // Caminho de onde a imagem ficará
	        $imagem_dir = "uploads/" . $imagem_nome;

	        // Faz o upload da imagem
	        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
			$sql_code = "INSERT INTO IMAGEM (NOME, DESCRICAO, CATEGORIA, URL, DATA_UPLOAD, ID_PESSOA) VALUES ('$nome', '$descricao', '$categoria', '$imagem_nome', NOW(), '1')"; //MUDAR O ID
			if($mysqli->query($sql_code)){
				$msg = "Arquivo enviado com sucesso!";
			}
			else
				$msg = "Falha ao enviar o arquivo";
                
                // Gera a miniatura
                require('interface/wideimage/lib/WideImage.php');
                $image = WideImage::load($imagem_dir);
                $image = $image->resize(750,450);
                $image->saveToFile('uploads/min_'.$imagem_nome);
                $imagem_min = 'uploads/min_'.$imagem_nome;
	    }
	}      
?>

<html>
<head>
		<title>Inserir Imagem</title>
		<meta charset="utf-8"/>
</head>
<body>
	<form action="inserir_imagem.php" method="POST" enctype="multipart/form-data">
            Nome da imagem: <input type="text" name="nome" required /><br>
            Descrição: <input type="text" name="descricao" required /><br>
            Categoria: <input type="text" name="categoria" required /><br>            
            <label for="imagem">Selecione a imagem:</label>
            <input type="file" name="foto" required /><br>
            <input type="submit" value="Enviar"/><br>
            <?php if($erro != "0") echo "<p>$erro</p>"; else echo "<p>$msg</p>"; ?>
            <br><?php if($msg != false) echo "<p><img src='$imagem_min'/></p> "; ?>
	</form>
</body>
</html>
