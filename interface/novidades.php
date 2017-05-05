    <section id="novidades" class="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-heading">
                            <h2>Novidades</h2>
                            <p class="text-muted">Esses são os destaques da comunidade Social Design</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="container">
        <!-- Projects Row -->
            <div class="row">
                
            <?php
            
            //include da conexão com o banco de dados
            include("interface/conexao.php");
            
            $verifica = $mysqli->query("SELECT * FROM imagem WHERE DESTAQUE='on' ORDER BY DATA_UPLOAD DESC LIMIT 9");
            while ($row = $verifica->fetch_array(MYSQLI_ASSOC)){
                $id = $row["ID"];
                $nome = $row["NOME"];
                $descricao = $row["DESCRICAO"];
                $categoria = $row["CATEGORIA"];
                $url = $row["URL"];
                $email = $row["DATA_UPLOAD"];

                echo"
                <div class='col-lg-4 col-sm-6 col-xs-12'>
                    <a href='imagem.php?id=$id' style='color: #333'><img src='uploads/min_$url' style='border: 1px solid #ccc; height:280px; width:100%' class='thumbnail img-responsive'>                                                   
                    <center><h3>$nome</a></h3></center>
                </div>";   
            }
			
            ?>

            </div>
			
			<center><br><br><a href="pesquisa.php?q=&tipo=Imagens" class="btn btn-primary btn-lg">Ver todas as imagens</a></center>
                
            </div>
    </section>