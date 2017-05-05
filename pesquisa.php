<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Social Design</title>
    
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
                        <center>
                            <div class="apresentation">                                    
                                                                                                                                                   
                                <?php

                                    include("interface/conexao.php");

                                    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

                                    $q = $_GET['q'];    
                                    $tipo = $_GET['tipo'];

									$busca = $_GET["busca"];
									
									//paginação
									$total_reg = "3";
									
									$pagina=$_GET['pagina'];
									if (!$pagina) {
										$pc = "1";
									} 
									else {
										$pc = $pagina;
									}
									 
									$inicio = $pc - 1;
									$inicio = $inicio * $total_reg;

                                    //PESQUISAR USUÁRIOS
                                    if (isset($q) && $tipo == 'Usuários') {
                                        $todos = $mysqli->query("SELECT * FROM pessoa WHERE NOME LIKE '%$q%' ORDER BY DATA_CADASTRO DESC");
										$limite = $mysqli->query("SELECT * FROM pessoa WHERE NOME LIKE '%$q%' ORDER BY DATA_CADASTRO DESC LIMIT $inicio,$total_reg");
										
										$tp = $todos->num_rows / $total_reg;

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($todos->num_rows<=0){
                                            echo "Nenhum usuário encontrado. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
                                            echo"<h1>Resultados da pesquisa de usuários para: $q</h1><br><br>
                                            <table> 
                                            <tr><center>
                                                <th><center>Nome</center></th>                                    
                                                <th><center>CPF / CNPJ</center></th>
                                                <th><center>Telefone</center></th>
                                                <th><center>Email</center></th>
                                                <th><center>Data de cadastro</center></th>
                                                <th><center>Portfólio</center></th>
                                            </center></tr>"; 
                                            while ($row = mysqli_fetch_array($limite, MYSQLI_ASSOC)){
                                                $id = $row["ID"];
                                                $nome = $row["NOME"];
                                                $cpf_cnpj = $row["CPF_CNPJ"];
                                                $fisica_juridica = $row["FISICA_JURIDICA"];
                                                $telefone = $row["TELEFONE"];
                                                $email = $row["EMAIL"];
                                                $data_cadastro = $row["DATA_CADASTRO"];

                                                echo "<tr>";               
                                                    echo "<td>".$nome."</td>";                
                                                    echo "<td>".$cpf_cnpj."</td>";                
                                                    echo "<td>".$telefone."</td>";                
                                                    echo "<td>".$email."</td>";                
                                                    echo "<td>".date('d/m/Y', strtotime($data_cadastro))."</td>";                
                                                    echo "<td><a href='portfolio.php?id=$id'>Ver Portfólio</a></td>";  
                                                echo "</tr>";
                                                
                                            }
                                            echo "</table>";
											
											echo "<div class='col-md-12' style='margin-top:20px;'>";
											// agora vamos criar os botões "Anterior e próximo"
											  $anterior = $pc -1;
											  $proximo = $pc +1;
											  if ($pc>1) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&&pagina=$anterior' class='btn btn-outline'><- Página Anterior</a> ";
											  }
											  if ($pc<$tp) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&pagina=$proximo' class='btn btn-outline'>Próxima Página -></a>";
											  }
											echo "</div>";
                                        }
                                    }

                                    //PESQUISAR VAGAS
                                    if (isset($q) && $tipo == 'Vagas') {
										$todos = $mysqli->query("SELECT * FROM vaga WHERE TITULO LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_VAGA DESC");
										$limite = $mysqli->query("SELECT * FROM vaga WHERE TITULO LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_VAGA DESC LIMIT $inicio,$total_reg");
										
										$tp = $todos->num_rows / $total_reg;

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($todos->num_rows<=0){
                                            echo "Nenhuma vaga encontrada. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
                                            echo"<h1>Resultados da pesquisa de vagas para: $q</h1><br><br>
                                            <table> 
                                            <tr><center>
                                                <th><center>Título</center></th>                                    
                                                <th><center>Salario</center></th>
                                                <th><center>Categoria</center></th>
                                                <th><center>Localizacao</center></th>
                                                <th><center>Data de publicação</center></th>
                                            </center></tr>"; 
                                            while ($row = mysqli_fetch_array($limite, MYSQLI_ASSOC)){
                                                $vaga_id = $row["ID"];
                                                $vaga_titulo = $row["TITULO"];
                                                $vaga_descricao = $row["DESCRICAO"];
                                                $vaga_salario = $row["SALARIO"];
                                                $vaga_categoria = $row["CATEGORIA"];
                                                $vaga_localizacao = $row["LOCALIZACAO"];
                                                $data_vaga = $row["DATA_VAGA"];  
                                                $id_pessoa = $row["ID_PESSOA"];

                                                echo "<tr>               
                                                    <td>$vaga_titulo</td>
                                                    <td>$vaga_salario</td>
                                                    <td>$vaga_categoria</td>
                                                    <td>$vaga_localizacao</td>
                                                    <td>"; echo date('d/m/Y', strtotime($data_vaga)); echo "</td>
                                                    <td><a href='vaga.php?id=$vaga_id'>Ver Detalhes</a></td>";                                                
                                            }
                                            echo "</table>";
											
											echo "<div class='col-md-12' style='margin-top:20px;'>";
											// agora vamos criar os botões "Anterior e próximo"
											  $anterior = $pc -1;
											  $proximo = $pc +1;
											  if ($pc>1) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&&pagina=$anterior' class='btn btn-outline'><- Página Anterior</a> ";
											  }
											  if ($pc<$tp) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&pagina=$proximo' class='btn btn-outline'>Próxima Página -></a>";
											  }
											echo "</div>";
                                        }
                                    }

                                    //PESQUISAR PRODUTOS
                                    if (isset($q) && $tipo == 'Produtos') {
										$todos = $mysqli->query("SELECT * FROM produto WHERE NOME LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_UPLOAD DESC");
										$limite = $mysqli->query("SELECT * FROM produto WHERE NOME LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_UPLOAD DESC LIMIT $inicio,$total_reg");
										
										$tp = $todos->num_rows / $total_reg;

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($todos->num_rows<=0){
                                            echo "Nenhum produto encontrado. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
                                            echo "<h1>Resultados da pesquisa de produtos para: $q</h1><br><br>";
                                            while ($row = mysqli_fetch_array($limite, MYSQLI_ASSOC)){
                                                $id = $row["ID"];
                                                $nome = $row["NOME"];
                                                $descricao = $row["DESCRICAO"];
                                                $categoria = $row["CATEGORIA"];
                                                $imagem_vinculada_url = $row["URL_IMAGEM"];
                                                $email = $row["DATA_UPLOAD"];
                                                
                                                echo"
                                                <div class='col-md-4'>
                                                    <img src='uploads/min_$imagem_vinculada_url' width='200px' height='150px'><br><br>                                                    
                                                    <a href='produto.php?id=$id' class='btn btn-outline btn-xl'>$nome</a><br><br>        
                                                </div>";                                                
                                            }
											
											echo "<div class='col-md-12' style='margin-top:20px;'>";
											// agora vamos criar os botões "Anterior e próximo"
											  $anterior = $pc -1;
											  $proximo = $pc +1;
											  if ($pc>1) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&&pagina=$anterior' class='btn btn-outline'><- Página Anterior</a> ";
											  }
											  if ($pc<$tp) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&pagina=$proximo' class='btn btn-outline'>Próxima Página -></a>";
											  }
											echo "</div>";
                                        }
                                    }                                         
                                    
                                    //PESQUISAR IMAGENS
                                    if (isset($q) && $tipo == 'Imagens') {
                                        $todos = $mysqli->query("SELECT * FROM imagem WHERE NOME LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_UPLOAD DESC");
										$limite = $mysqli->query("SELECT * FROM imagem WHERE NOME LIKE '%$q%' OR DESCRICAO LIKE '%$q%' ORDER BY DATA_UPLOAD DESC LIMIT $inicio,$total_reg");
										
										$tp = $todos->num_rows / $total_reg;

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($todos->num_rows<=0){
                                            echo "Nenhuma imagem encontrada. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
											if ($q == ''){
												echo "<h1>Últimas imagens enviadas</a><br><br>";
											}
											else{
												echo "<h1>Resultados da pesquisa de imagens para: $q</h1><br><br>";
											}
                                            
                                            while ($row = mysqli_fetch_array($limite, MYSQLI_ASSOC)){
                                                $id = $row["ID"];
                                                $nome = $row["NOME"];
                                                $descricao = $row["DESCRICAO"];
                                                $categoria = $row["CATEGORIA"];
                                                $url = $row["URL"];
                                                $email = $row["DATA_UPLOAD"];
                                                
                                                echo"
                                                <div class='col-md-4'>
                                                    <img src='uploads/min_$url' width='200px' height='150px'><br><br>                                                    
                                                    <a href='imagem.php?id=$id' class='btn btn-outline btn-xl'>$nome</a><br><br>        
                                                </div>";                                                
                                            }

											echo "<div class='col-md-12' style='margin-top:20px;'>";
											// agora vamos criar os botões "Anterior e próximo"
											  $anterior = $pc -1;
											  $proximo = $pc +1;
											  if ($pc>1) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&&pagina=$anterior' class='btn btn-outline'><- Página Anterior</a> ";
											  }
											  if ($pc<$tp) {
											  echo "<a href='pesquisa.php?q=$q&tipo=$tipo&pagina=$proximo' class='btn btn-outline'>Próxima Página -></a>";
											  }
											echo "</div>";
                                        }
                                    }
                                ?>
  
                            </div>
                        </center>
                    </div>  
                </div>
            </div>
        </div>
    </header>
    
    <?php include 'interface/comunidade.php'; ?>
    <?php include 'interface/footer.php'; ?>
    

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