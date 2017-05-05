    <header>
            <div class="container">
                    <div class="row">
                        <div class="header-content">
                        <div class="container">
                            <div class="apresentation">
                            <div class="col-md-4">
							
								<center><img class="img-responsive" src="img/gif.gif" style="height: 350px;" alt=""></center>
							
                                <br><a href="login.php"><img class="img-responsive" src="" alt=""></a>
                                    <a href="login.php" class="btn btn-outline btn-xl"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</a>        

                                <a href="cadastro.php"><img class="img-responsive" src="" alt=""></a>
                                    <a href="cadastro.php" class="btn btn-outline btn-xl"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Cadastro</a><br>
									
									
                            </div>
                            <div class="col-md-8">        
                                    <br> <?php include 'carousel.php';?>
                            </div>       
                                </div></center>
                        </div>    
 
                            <div class="header-content-inner">        
                                <center>
                                <div class="container">
                                    
                                    <div class="input-group">
                                    <form name="searchform" method="get" action="pesquisa.php" class="navbar-form navbar">
                                        <input type="text" name="q" class="form-control" placeholder="Pesquisar..." required >                                        
                                        <select class="form-control" name="tipo">
                                            <option>Imagens</option>
                                            <option>Produtos</option>
                                            <option>Usuários</option>
                                            <option>Vagas</option>
                                        </select>
                                        <span class="input-group-btn"><input type="submit" class="btn btn-default" value="ok"></span>
                                    </form>
                                    </div>                                                     
                                
                                </div>
                                </center>
                            </div>
                        </div>
                        </div>
                    </div>
    </header>