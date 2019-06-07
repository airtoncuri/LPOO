<?php

include_once "Conexao.php";

include_once "ItemPedidoPDO.php";

/**
 * Descreva aqui a classe PedidoPDO
 *
 * @author vagner
 */
class PedidoPDO extends Conexao{
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($pedido){
        try{
            $this->conn->beginTransaction(); //-------------- início da transação, desliga o autocommit
            $stmt = $this->conn->prepare("INSERT INTO pedidos (pagamento, estado, data_criacao, data_modificacao, id_cliente, total_pedido, situacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $pedido->getFormaPagamento());
            $stmt->bindValue(2, 'aberto');
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d H:i');
            $stmt->bindValue(3, $date); //pega a data e hora do sistema
            $stmt->bindValue(4, $date); //pega a data e hora do sistema
            $stmt->bindValue(5, $pedido->getCliente()->getId());
            $stmt->bindValue(6, $pedido->getTotalPedido());
            $stmt->bindValue(7, true); //um literal para insert
            if($stmt->execute()){
                $id_pedido = $this->conn->lastInsertId();
                echo "\nId do pedido gerado = " . $id_pedido;
                foreach ($pedido->getItens() as $item){ //adiciona todos os itens e atualiza o estoque
                    $stmt = $this->conn->prepare("INSERT INTO itens (id_produto, id_pedido, quantidade, total_item, situacao) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bindValue(1, $item->getProduto()->getId());
                    $stmt->bindValue(2, $id_pedido);
                    $stmt->bindValue(3, $item->getQuantidade());
                    $stmt->bindValue(4, $item->getTotalItem());
                    $stmt->bindValue(5, true);
                    if($stmt->execute()){ //se adicionou o item
                        $stmt = $this->conn->prepare("UPDATE produtos SET quantidade=? WHERE id=?");
                        $stmt->bindValue(1, $item->getProduto()->getQuantidade() - $item->getQuantidade());
                        $stmt->bindValue(2, $item->getProduto()->getId());
                        if(!$stmt->execute()){ //se não atualizou o estoque
                            throw PDOException;
                        }
                    }else{
                        throw PDOException;
                    }                   
                }
                //depois de criar o pedido, inserir os itens, e atualizar o estoque, executa o commit no banco
                if($this->conn->commit()){ //-------------- fim da transação, volta para o autocommit
                    return true;
                }    
                return false;
            } 
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            $this->conn->rollBack();
            return false;
        }
    }
}
