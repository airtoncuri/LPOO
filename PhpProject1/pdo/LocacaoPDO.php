<?php

include_once "../model/Locacao.php";

include_once "Conexao.php";

include_once "SocioPDO.php";

/**
 * Descreva aqui a classe LocacaoPDO
 *
 * @author airton
 */
class LocacaoPDO extends Conexao {
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($locacao){
        try{
            $stmt = $this->conn->prepare("INSERT INTO locacao "
                . "(dataLoc, dataDev, valorLoc, situacao, socio, itemLocacao) "
                . "VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $locacao->getDataLoc());
            $stmt->bindValue(2, $locacao->getDataDev());
            $stmt->bindValue(3, $locacao->getValorLoc());
            $stmt->bindValue(4, $locacao->getSituacao());
            $stmt->bindValue(5, $locacao->getSocio());
            $stmt->bindValue(6, $locacao->getItemLocacao());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ProdutoPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($produto){
        try{
            $stmt = $this->conn->prepare("UPDATE produtos SET nome=?, descricao=?, "
                    . "valor=?, situacao=?, quantidade=? WHERE id = ?");
            $stmt->bindValue(1, $produto->getNome());
            $stmt->bindValue(2, $produto->getDescricao());
            $stmt->bindValue(3, $produto->getValor());
            $stmt->bindValue(4, $produto->getSituacao());
            $stmt->bindValue(5, $produto->getQuantidade());
            $stmt->bindValue(6, $produto->getId());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ProdutoPDO->update: " . $ex->getMessage();
            return false;
        }
    }

    public function deleteSoft($id){
        try{
            $stmt = $this->conn->prepare("UPDATE produtos SET situacao=? WHERE id=?");
            $stmt->bindValue(1, false);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ProdutoPDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function reativarProdutoPeloId($id){
        try{
            $stmt = $this->conn->prepare("UPDATE produtos SET situacao=? WHERE id=?");
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ProdutoPDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM vendas.produtos ORDER BY nome");
            if($stmt->execute()){
                $produtos = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($produtos, $this->resultSetToProduto($rs));
            }
            
            return $produtos;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ProdutoPDO: " . $ex->getMessage();
            return null;    
        }     
    }
    
    public function findAllWithoutDeleted(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM vendas.produtos WHERE situacao = ? ORDER BY nome");
            $stmt->bindValue(1, true);
            if($stmt->execute()){
                $produtos = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($produtos, $this->resultSetToProduto($rs));
            }
            
            return $produtos;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ProdutoPDO: " . $ex->getMessage();
            return null;    
        }
    }

    public function findByNome($nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE nome LIKE ? ORDER BY nome");
            $stmt->bindValue(1, $nome . '%');
            if ($stmt->execute()) {
                $produtos = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($produtos, $this->resultSetToProduto($rs));
                }
                return $produtos;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe ProdutoPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToProduto($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe ProdutoPDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToProduto($rs){
        $produto = new Produto();
        $produto->setId($rs->id);
        $produto->setNome($rs->nome);
        $produto->setDescricao($rs->descricao);
        $produto->setValor($rs->valor);
        $produto->setSituacao($rs->situacao);
        $produto->setQuantidade($rs->quantidade);
        
        return $produto;
    }
    
}
