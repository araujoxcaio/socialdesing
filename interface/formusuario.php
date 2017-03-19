<header>
<div class="container">    
        <div class="row">  
            <div class="col-md-12">
            <center>
            <div class="formcadastro">  
                <h1> Cadastro Usuário </h1>
            <form action="home.php" method="POST">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="digite seu nome" value="" />
                </div>
                <div class="form-group">
                    <label>Nome do Usuário</label>
                    <input type="text" class="form-control" name="nomeusuario" placeholder="usuario" value=""/>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="user@domain.com" value="" />
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input type="text" class="form-control" name="endereco" placeholder="" value="" />
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" class="form-control" name="telefone" placeholder="" value="" />
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