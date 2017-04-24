<?php

if(isset($_POST['enviar'])){
	
	$mensagem = "(Mensagem enviada por ".$_POST['nome']." em ".date('d.m.y')." através do formulário de contato do site): \n \n".$_POST['mensagem']."\n";
    $headers = "From: ".$_POST['email']."\n";
    $headers .= "X-Sender: <".$_POST['email'].">\n";
    $headers .= "X-Mailer: PHP  v".phpversion()."\n";
    $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
    $headers .= "MIME-Version: 1.0\n";
	
	mail('fsocialdesign@gmail.com', "[SOCIAL DESIGN] Formulário de contato - ".$_POST['assunto'], $mensagem, $headers);
	
	echo"<script language='javascript' type='text/javascript'>alert('Mensagem enviada com sucesso! Aguarde que em breve retornaremos');window.location.href='../index.php';</script>";
}

?>
	
	<section id="contato" class="download text-center" style="background: #ccc;">
                    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Entre em contato conosco</h1>
            </div>
            <p> Utilize o formulário abaixo para se comunicar conosco:</p>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
             <div class="row">  
                <div class="col-md-12">
                <center>
                <div class="formcadastro">  
                    <form action="/interface/contato.php" method="POST" enctype="multipart/form-data">                        
                            <div class="form-group">
                                <label for="nome">Seu nome</label>
                                <input type="text" class="form-control" name="nome" required />
                            </div> 
                        
                            <div class="form-group">
                                <label for="descricao">Seu e-mail</label>
                                <input type="text" class="form-control" name="email" value="" required />
                            </div>  
                        
                            <div class="form-group">
                                <label>Assunto</label>
                                <select class="form-control" name='assunto'>
									<option value='selecione' selected disabled>(Selecione um assunto)</option>
                                    <option value='Alteração de cadastro'>Alteração de cadastro</option>
                                    <option value='Dúvidas'>Dúvidas</option>
                                    <option value='Sugestões / Reclamações'>Sugestões / Reclamações</option>
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
    </section>
