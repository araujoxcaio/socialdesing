<?php
    session_start();
?>

<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>Menu<i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php">Social Design</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="index.php#sobre">Sobre</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="index.php#novidades">Novidades</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="index.php#contato">Contato</a>
                        </li>
                         
                        <?php if(isset($_SESSION['email'])){
                            $email = $_SESSION['email'];
                            echo "
                            <li><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-log-in'></span> $email</a>
                            <ul id='login-dp' class='dropdown-menu'>
                            <li>   
                                <div id='formrow' class='row'>
                                    <div class='formlogin'><br>";
                            
                                    if($_SESSION['id'] == '1'){
                                    echo"
                                        <div class='form-group'>
                                            <a href='admin.php'><input type='submit' name='perfil' class='btn btn-outline btn-block' value='Administração'></a>
                                        </div>";
                                    } echo"
                                        <div class='form-group'>
                                            <a href='perfil.php'><input type='submit' name='perfil' class='btn btn-outline btn-block' value='Editar Perfil'></a>
                                        </div>
                                        
                                        <div class='form-group'>
                                            <a href='gportfolio.php'><input type='submit' name='perfil' class='btn btn-outline btn-block' value='Meu Portfólio'></a>
                                        </div>
                                        
                                        <div class='form-group'>
                                            <a href='interface/efetuarlogout.php'><input type='submit' name='logout' class='btn btn-outline btn-block' value='Fazer Logout'></a>
                                        </div>
                                    </div>
                                </div>                               
                            </li>
                            </ul></li>";
                        }            
                       
                        else{
                            echo "
                            <li><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-log-in'></span> ENTRAR</a>
                            <ul id='login-dp' class='dropdown-menu'>
                            <li>   
                                <div id='formrow' class='row'>
                                    <form class='formlogin' name='login' action='http://localhost/SocialDesign/interface/efetuarlogin.php' method='POST' accept-charset='UTF-8'><!-- ALTERAR O LINK-->
                                        <div class='form-group'>
                                            <label class='sr-only'>E-mail</label>
                                            <input type='text' name='email' class='form-control' id='email' placeholder='e-mail' required>
                                        </div>
                                        <div class='form-group'>
                                        <label class='sr-only'>Senha</label>
                                            <input type='password' name='password' class='form-control' id='password' placeholder='senha' required>
                                        </div>
                                        <div class='form-group'>
                                            <input type='submit' name='entrar' class='btn btn-outline btn-block ' value='ENTRAR'>
                                        </div>
                                    </form>
                                    <div class='bottom text-center'>
                                        <h6>Novo por aqui? <a href='cadastro.php'>Cadastre-se já!</a></h6>
                                    </div>
                                </div>
                               
                            </li>
                            </ul></li>";
                            
                        }
                        ?>                                         
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>