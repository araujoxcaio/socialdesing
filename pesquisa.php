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

                                    $t_buscar = $_POST['t_buscar'];
                                    $s_buscar = $_POST['s_buscar'];     
                                    $c_buscar = $_POST['c_buscar'];     

                                    //PESQUISAR USUÁRIOS
                                    if (isset($s_buscar) && $c_buscar == 'Usuários') {
                                        $verifica = $mysqli->query("SELECT * FROM PESSOA WHERE NOME LIKE '%$t_buscar%'");

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($verifica->num_rows<=0){
                                            echo "Nenhum usuário encontrado. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
                                            echo"<h1>Resultados da pesquisa de usuários para: $t_buscar</h1><br><br>
                                            <table> 
                                            <tr><center>
                                                <th><center>Nome</center></th>                                    
                                                <th><center>CPF / CNPJ</center></th>
                                                <th><center>Telefone</center></th>
                                                <th><center>Email</center></th>
                                                <th><center>Data de cadastro</center></th>
                                                <th><center>Portfólio</center></th>
                                            </center></tr>"; 
                                            while ($row = $verifica->fetch_array(MYSQLI_ASSOC)){
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
                                                    echo "<td>".$data_cadastro."</td>";                
                                                    echo "<td><a href='portfolio.php?id=$id'>Ver Portfólio</a></td>";  
                                                echo "</tr>";
                                                
                                            }
                                            echo "</table>";
                                        }
                                    }
                                    
                                    //PESQUISAR IMAGENS
                                    if (isset($s_buscar) && $c_buscar == 'Imagens') {
                                        $verifica = $mysqli->query("SELECT * FROM IMAGEM WHERE NOME LIKE '%$t_buscar%' or DESCRICAO LIKE '%$t_buscar%'");

                                        //verificando se o resultado da consulta é menor ou igual a 0, ou seja, não encontrou os dados no banco
                                        if ($verifica->num_rows<=0){
                                            echo "Nenhuma imagem encontrada. Por favor, tente novamente.";
                                            die();
                                        }        
                                        //caso tenha encontrado os dados, prossegue...
                                        else{
                                            echo "<h1>Resultados da pesquisa de imagens para: $t_buscar</h1><br><br>";
                                            while ($row = $verifica->fetch_array(MYSQLI_ASSOC)){
                                                $id = $row["ID"];
                                                $nome = $row["NOME"];
                                                $descricao = $row["DESCRICAO"];
                                                $categoria = $row["CATEGORIA"];
                                                $url = $row["URL"];
                                                $email = $row["DATA_UPLOAD"];
                                                
                                                echo"
                                                <div class='col-md-4'>
                                                    <img src='uploads/min_$url' width='200px' height='150px'><br><br>                                                    
                                                    <a href='#' class='btn btn-outline btn-xl'>$nome</a><br><br>        
                                                </div>";                                                
                                            }
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