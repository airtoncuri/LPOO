<?php

include_once "Conexao.php";

include_once "../model/ItemPedido.php";

include_once "ProdutoPDO.php";

/**
 * Descreva aqui a classe ItemPedidoPDO
 *
 * @author vagner
 */
class ItemPedidoPDO extends Conexao{
    
    private $conn;
    private $produtoPDO;
   
    public function __construct() {
        $this->conn = parent::getConexao();
        $this->produtoPDO = new ProdutoPDO();
    }
    
    public function deleteSoft($id) {
        
    }
    
    public function findByIdPedido($id) {
        try{
            $stmt = $this->conn->prepare("SELECT * FROM itens WHERE id_pedido = ?");
            $stmt->bindValue(1, $id);
            if($stmt->execute()){
                $itens = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($itens, $this->resultSetToItem($rs));
                }
                return $itens; 
            }
            return null;
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return null;
        }
    }
    
    /*
     * Método utilitário.
     * Converte um objeto ResultSet em ItemPedido.
     */
    private function resultSetToItem($rs) {
        $item = new ItemPedido($this->produdoPDO->findById($rs->id_produto));
        $item->setQuantidade($rs->quantidade);
        $item->setTotalItem($rs->total_item);
        $item->setSituacao($rs->situacao);
        return $item;
    }
}
