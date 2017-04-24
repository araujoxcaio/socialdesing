<?php
    //include da conexão com o banco de dados
    include("interface/conexao.php");
    
    //ignorando "notices"
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

    session_start();
    
    //verificando se está logado
    if(!isset($_SESSION["email"])){
        header("Location: login.php");
        exit;        
    }
    
    $id = $_GET["id"];  
    
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
    
    $pessoa = $mysqli->query("SELECT * FROM pessoa WHERE ID = '$id_pessoa'");
    while ($row = $pessoa->fetch_array(MYSQLI_ASSOC)){
        $pessoa_nome = $row["NOME"];
        $pessoa_email = $row["EMAIL"];
    }

	$mensagem = "Olá, ".$pessoa_nome."!\n
	Este é um e-mail automático da Social Design.\n
	O usuário ".$_SESSION['nome']." mostrou interesse pela vaga ".$vaga_titulo." divulgada em nosso site.\n
	Caso tenha interesse em conhecer o portfólio deste usuário, para visualizar seus dados pessoais e seus projetos disponibilizados em nosso site, acesse pelo link a seguir:\n
	https://socialdesign.000webhostapp.com/portfolio.php?id=".$_SESSION['id']."\n
Atenciosamente,
Equipe Social Design\n\n";
    $headers = "From: fsocialdesign@gmail.com\n";
    $headers .= "X-Sender:  <fsocialdesign@gmail.com>\n"; //email do servidor //que enviou
    $headers .= "X-Mailer: PHP  v".phpversion()."\n";
    $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
    $headers .= "MIME-Version: 1.0\n";

    //mail($para, $pessoa_nome, $pessoa_email, $mensagem, $headers);  //função que faz o envio do email.
        
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
		function msg()
		{
		alert("Sua candidatura foi enviada com sucesso. Aguarde a empresa entrar em contato. Boa sorte!");
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
                                <h4><b>Email:</b> $pessoa_email</h4>  
                                <h4><b>Data de publicação: </b>"; echo date('d/m/Y', strtotime($data_vaga)); echo "</h4><br><br>                              
                                
                                ";?>  
                                
                                <?php
                                    //verificando se a pessoa é física, para poder se cadastrar
                                    if($_SESSION["fisica_juridica"] == 'F'){
                                        $idatual = $_SESSION['id'];
                                        echo "<center><input type='button' onclick='msg()' class='btn btn-success' value='Candidatar-se a vaga'</center>", 
                                        mail($pessoa_email, "[SOCIAL DESIGN] Vaga de emprego - ".$vaga_titulo, $mensagem, $headers);
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
