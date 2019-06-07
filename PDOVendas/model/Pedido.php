<?php

/**
 * Description of Pedido
 *
 * @author vpsil
 */
class Pedido {

    private $id;
    private $formaPagamento;
    private $estado;
    private $dataCriacao;
    private $dataModificacao;
    private $totalPedido;
    private $situacao;
    private $cliente; //associa com a classe Cliente
    private $itens; //associa com a classe ItemPedido

    public function __construct($itens) {
        $this->itens = $itens;
    }

    public function getId() {
        return $this->id;
    }

    public function getFormaPagamento() {
        return $this->formaPagamento;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function getDataModificacao() {
        return $this->dataModificacao;
    }

    public function getTotalPedido() {
        return $this->totalPedido;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getItens() {
        return $this->itens;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFormaPagamento($formaPagamento) {
        $this->formaPagamento = $formaPagamento;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function setDataModificacao($dataModificacao) {
        $this->dataModificacao = $dataModificacao;
    }

    public function setTotalPedido($totalPedido) {
        $this->totalPedido = $totalPedido;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setItens($itens) {
        $this->itens = $itens;
    }

        
    public function __toString() {
        return "\nPedido[id=$this->id, forma de pagamento=$this->formaPagamento, estado=$this->estado, data de criação=$this->dataCriacao, data de modificação=$this->dataModificacao, total do pedido=$this->totalPedido, situação=$this->situacao, $this->itens]";
    }

}
