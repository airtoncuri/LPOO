<?php

/**
 * Description of Produto
 *
 * @author vpsil
 */
class Produto {

    private $id;
    private $nome;
    private $descricao;
    private $valor;
    private $quantidade;
    private $situacao;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    
    public function __toString() {
        return "\nProduto[id=$this->id, Nome=$this->nome, Descricao=$this->descricao, Valor=$this->valor, Estoque=$this->quantidade, Situacao=$this->situacao";
    }

}
