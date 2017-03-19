<?php 

	include("interface/conexao.php");//teste

	error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
	$erro = $config = array();

	// Prepara a variável do arquivo
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

	// Tamanho máximo do arquivo (em bytes)
	$config["tamanho"] = 10000;
 
	// Largura máxima (pixels)
	$config["largura"] = 350;

	// Altura máxima (pixels)
	$config["altura"]  = 180;

	// Formulário postado... executa as ações
	if ($arquivo) {  
	    // Verifica se o mime-type do arquivo é de imagem
	    if (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"])) {
	        $erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";
	    } else {
	        // Verifica tamanho do arquivo
	        if ($arquivo["size"] > $config["tamanho"]) {
	            $erro[] = "Arquivo em tamanho muito grande! A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. Envie outro arquivo";
	        }
	        
	        // Para verificar as dimensões da imagem
	        $tamanhos = getimagesize($arquivo["tmp_name"]);
	        
	        // Verifica largura
	        if ($tamanhos[0] > $config["largura"]) {
	            $erro[] = "Largura da imagem não deve ultrapassar " . $config["largura"] . " pixels";
	        }

	        // Verifica altura
	        if ($tamanhos[1] > $config["altura"]) {
	            $erro[] = "Altura da imagem não deve ultrapassar " . $config["altura"] . " pixels";
	        }
	    }
	    
	    // Imprime as mensagens de erro
	    if (sizeof($erro)) {
	        foreach ($erro as $err) {
	            echo " - " . $err . "<BR>";
	        }

	        //echo "<a href=\"foto.html\">Fazer Upload de Outra Imagem</a>";
	    }

	    // Verificação de dados OK, nenhum erro ocorrido, executa então o upload...
	    else
	    {
	        // Pega extensão do arquivo
	        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

	        // Gera um nome único para a imagem
	        $imagem_nome = md5(uniqid(time())) . "." . $ext[1];

	        // Caminho de onde a imagem ficará
	        $imagem_dir = "uploads/" . $imagem_nome;

	        // Faz o upload da imagem
	        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
			$sql_code = "INSERT INTO IMAGEM (NOME, DESCRICAO, CATEGORIA, IMAGEM, DATA) VALUES ('TESTE', 'TESTE', 'TESTE', '$novo_nome', NOW())";
			if($mysqli->query($sql_code)){
				$msg = "Arquivo enviado com sucesso!";
			}
			else
				$msg = "Falha ao enviar o arquivo";
	    }
	}

	/*$msg = false;
	$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

	if($arquivo){
		$extensao = strtolower(substr($_FILES['imagem']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = "uploads/";

		move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);

		if (!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"])) {
        	$msg = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";
    	} 
    	
    	else {
			$sql_code = "INSERT INTO IMAGEM (NOME, DESCRICAO, CATEGORIA, IMAGEM, DATA) VALUES ('TESTE', 'TESTE', 'TESTE', '$novo_nome', NOW())";
			if($mysqli->query($sql_code)){
				$msg = "Arquivo enviado com sucesso!";
			}
			else
				$msg = "Falha ao enviar o arquivo";
		}
		
	}*/

?>

<html>
<head>
		<title>Upload de imagens</title>
		<meta charset="utf-8"/>
</head>
<body>
<?php if($msg != false) echo "<p> $msg </p>"; ?>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<label for="imagem">Selecione a(s) imagen(s):</label><br>
		<input type="file" name="foto" multiple required />
		<input type="submit" value="Enviar"/>
	</form>
</body>
</html>