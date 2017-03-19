<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>Menu<i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">Social Design</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#download">Sobre</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#features">Novidades</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contato</a>
                        </li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Entrar</a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>   
                                <div id="formrow" class="row">
                                    <form class="formlogin" name="login" action="home.php" method="POST" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <label class="sr-only">Usuário</label>
                                            <input type="text" name="nomeusuario" class="form-control" id="nomeusuario" placeholder="usuario" required>
                                        </div>
                                        <div class="form-group">
                                        <label class="sr-only">Senha</label>
                                            <input type="password" name="senha" class="form-control" id="senha" placeholder="senha" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="entrar" class="btn btn-outline btn-block ">Entrar</button>                             
                                        </div>
                                    </form>
                                    <div class="bottom text-center">
                                        <h6>Novo por aqui? <a href="cadastro.php">Cadastre-se já!</a></h6>
                                    </div>
                                </div>
                               
                            </li>
                        </ul>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>