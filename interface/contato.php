    <section id="contato" class="download text-center" style="background: #ccc;">
            <div class="container">
                <div class="row">
                    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Entre em contato</h1>
            </div>
            <p> Utilize o formulário abaixo para se comunicar conosco:</p>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
             <div class="row">  
                <div class="col-md-12">
                <center>
                <div class="formcadastro">  
                    <form action="contato.php" method="POST" enctype="multipart/form-data">                        
                            <div class="form-group">
                                <label for="nome">Seu nome</label>
                                <input type="text" class="form-control" name="nome" required />
                            </div> 
                        
                            <div class="form-group">
                                <label for="descricao">Seu e-mail</label>
                                <input type="text" class="form-control" name="descricao" value="" required />
                            </div>  
                        
                            <div class="form-group">
                                <label>Assunto</label>
                                <select class="form-control" name='categoria'>
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
                            
                            <div class="form-group">
                                <label>Mensagem</label>
                                <textarea name="mensagem" class="form-control" rows="5"></textarea>
                            </div><br>

                            <input class="btn btn-primary" type="submit" name="enviar" value="Enviar" />
                            <a href="index.php" class="btn btn-info">Limpar</a><br>		
                    </form>                    
                </div>
                </center>        
                </div>
            </div>
                </div>
            </div>
    </section>