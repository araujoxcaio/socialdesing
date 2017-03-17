<?php

class Portfolio {
    private $id_imagem;
    private $nomedaimagem;
    private $categoria;
    private $descricaoimagem;
    private $arquivo;
}
function construct($id_imagem, $nomedaimagem, $categoria, $descricaoimagem, $arquivo){
    $this->ID_IMAGEM = $id_imagem;
    $this->NOMEDAIMAGEM = $nomedaimagem;
    $this->CATEGORIA = $categoria;
    $this->DESCRICAOIMAGEM = $descricaoimagem;
    $this->ARQUIVO = $arquivo;
}