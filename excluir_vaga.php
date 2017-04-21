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
            echo"<script language='javascript' type='text/javascript'>alert('Esta vaga não pertence ao seu usuário. Você só pode excluir as suas vagas!');window.location.href='gportfolio.php';</script>";
        }
        
        else{ 
            //delete no banco de dados
            $delete = $mysqli->query("DELETE FROM vaga WHERE ID = '$id'");            
            if(!$delete){
                echo "Erro no banco de dados: ". $mysqli->error;
            }

            echo"<script language='javascript' type='text/javascript'>alert('Vaga excluída com sucesso!');window.location.href='gportfolio.php';</script>"; //exibindo mensagem de sucesso e redirecionando para a página do portfólio
        }
    }
 ?>
