<header>
<div class="container">    
        <div class="row">  
            <div class="col-md-12">
            <center>
            <div class="formcadastro">  
                <h1> Cadastro Usuário </h1>
            <form action="interface/inserepessoa.php" method="POST">
                <div class="form-group">
                    <label>Nome do Usuário</label>
                    <input type="text" class="form-control" name="username" placeholder="Digite seu nome de usuário" value=""/>
                </div>
                <div class="form-group">
                    <label for="Email">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="user@domain.com" value="" />
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="digite sua senha" value="" />
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Cadastrar" />
                <a href="index.php" class="btn btn-info">Voltar</a>
            </form>
            </div>
            </center>        
            </div>
        </div>
    </div>
</header>