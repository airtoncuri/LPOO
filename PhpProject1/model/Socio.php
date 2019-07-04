<?php

class Socio {
    private $id;
    private $nome;
    private $endereco;
    private $telefone;
    private $situacao;
    private $locacao; //associa com a classe locacao
    
    
    public function __construct() {
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function getEndereco(){
        return $this->endereco;
    }
    
    public function getTelefone(){
        return $this->telefone;
    }
    
    public function getSituacao(){
        return $this->situacao;
    }
    
    public function getLocacao(){
        return $this->locacao;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }
    
    public function setTelefone ($telefone){
        $this->telefone = $telefone;
    }
    
    public function setSituacao ($situacao){
        $this->situacao = $situacao;
    }
    
    public function setLocacao ($locacao){
        $this->locacao = $locacao;
    }
    
    public function __toString() {
        return "\Socio[id=$this->id, nome=$this->nome, endereco=$this->endereco, telefone=$this->telefone, locacao=$this->locacao, situacao=$this->situacao]";
    }
}
