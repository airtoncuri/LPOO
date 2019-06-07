<?php

/**
 * Description of Cliente
 *
 * @author vpsil
 */
class Cliente {

    private $id;
    private $nome;
    private $sobrenome;
    private $situacao;
    private $pedidos = Array();
    

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
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

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    
    public function getPedidos() {
        return $this->pedidos;
    }

    public function setPedidos($pedidos) {
        $this->pedido = $pedidos;
    }

        
    public function __toString() {
        return "\nCliente[id=$this->id, nome=$this->nome, sobrenome=$this->sobrenome, situação=$this->situacao, " . print_r($pedidos) . "]";
    }

}
