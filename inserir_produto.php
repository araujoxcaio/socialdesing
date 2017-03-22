<?php 
    include("interface/conexao.php");
    
    	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
       
        $nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$categoria = $_POST['categoria'];

	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
	$arquivop = isset($_FILES["produto"]) ? $_FILES["produto"] : FALSE;

	// Tamanho máximo do arquivo (em bytes)
	$config["tamanho"] = 5000000;        
	$configp["tamanho"] = 100000000;        

        $erro = "0";
	// Formulário postado... executa as ações
	if ($arquivo && $arquivop) { 
            
	    // Verifica as extensões
	    if (!eregi("^image\/(pjpeg|jpeg|png|gif|jpg|svg|bmp)$", $arquivo["type"]) || $arquivo["size"] > $config["tamanho"]) {
	        $erro = "Arquivo inválido! A imagem deve ser nas extensões jpg, jpeg, bmp, gif, png ou svg e conter no máximo 5MB.";
	    }
            
            if (!eregi("^image\/(pjpeg|jpeg|png|gif|jpg|svg|bmp)$", $arquivop["type"]) || $arquivop["size"] > $configp["tamanho"]) {
	        $erro = "Arquivo inválido! O arquivo deve ser nas extensões zip|rar|blend|fbx|3ds|obj e conter no máximo 100MB.";
	    }  

	    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
	    else
	    {
	        // Pega extensão do arquivo
	        preg_match("/\.(gif|bmp|png|jpg|jpeg|svg){1}$/i", $arquivo["name"], $ext);
	        preg_match("/\.(gif|bmp|png|jpg|jpeg|svg){1}$/i", $arquivop["name"], $ext);

	        // Gera um nome único para a imagem
	        $imagem_nome = md5(uniqid(time())) . "." . $ext[1];
	        $produto_nome = md5(uniqid(time())) . "." . $ext[1];

	        // Caminho de onde a imagem ficará
	        $imagem_dir = "uploads/" . $imagem_nome;
	        $produto_dir = "uploads/" . $produto_nome;

	        // Faz o upload da imagem
	        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
	        move_uploaded_file($arquivop["tmp_name"], $produto_dir);
			$sql_code = "INSERT INTO PRODUTO (NOME, DESCRICAO, CATEGORIA, URL_IMAGEM, URL_ARQUIVO, DATA_UPLOAD) VALUES ('$nome', '$descricao', '$categoria', '$imagem_nome', '$produto_nome', NOW())";
			if($mysqli->query($sql_code)){
				$msg = "Arquivos enviados com sucesso!";
			}
			else
				$msg = "Falha ao enviar os arquivos";
                
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
		<title>Inserir Produto</title>
		<meta charset="utf-8"/>
</head>
<body>
	<form action="inserir_produto.php" method="POST" enctype="multipart/form-data">
            Nome do produto: <input type="text" name="nome" required /><br>
            Descrição: <input type="text" name="descricao" required /><br>
            Categoria: <input type="text" name="categoria" required /><br>            
            <label for="imagem">Imagem vinculada:</label>
            <input type="file" name="foto" required /><br>
            <label for="produto">Selecionar produto:</label>
            <input type="file" name="produto" required /><br>
            <input type="submit" value="Enviar"/><br>
            <?php if($erro != "0") echo "<p>$erro</p>"; else echo "<p>$msg</p>"; ?>
            <br><?php if($msg != false) echo "<p><img src='$imagem_min'/></p> "; ?>
	</form>
</body>
</html>