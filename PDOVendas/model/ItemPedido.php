<?php

/**
 * Description of ItemPedido
 *
 * @author vpsil
 */
class ItemPedido {
    
    private $id;
    private $id_pedido;
    private $produto; //associação com a classe Produto
    private $quantidade;
    private $totalItem;
    private $situacao;
        
    public function __construct($produto) {
        $this->produto = $produto; //composição
    }
    
    public function getId() {
        return $this->id;
    }

    public function getId_pedido() {
        return $this->id_pedido;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getTotalItem() {
        return $this->totalItem;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setTotalItem($totalItem) {
        $this->totalItem = $totalItem;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }
    
    public function __toString() {
        return "\nItemPedido[id=" . $this->id . ", id_pedido=" . $this->id_pedido . " " . $this->produto . ", Quantidade=$this->quantidade, Total do Item=$this->totalItem, Situação=$this->situacao]";
    }


    
}
