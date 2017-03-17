<?php

class Juridica extends Pessoa {
    private $cnpj;
    private $descricaoempresa;
}
function construct($cpf, $nome, $nomeusuario, $email, $endereco, $telefone, $senha, $descricaoempresa){
    $this->CPF = $cpf;
    $this->NOME = $nome;
    $this->NOMEUSUARIO = $nomeusuario;
    $this->EMAIL = $email;
    $this->ENDERECO = $endereco;
    $this->TELEFONE = $telefone;
    $this->SENHA = $senha;
    $this->DESCRICAOEMPRESA = $descricaoempresa;
}
function cadastrarEmpresa(){
    
}
function loginJuridico(){
    
}
function editarPerfilEmpresa(){
    
}
function cadastrarVaga(){
    
}
function editarVaga(){
    
}
function excluirVaga(){
    
}
function comprarProduto(){
    
}
