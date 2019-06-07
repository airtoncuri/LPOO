<?php

include_once "../model/Cliente.php";

include_once "Conexao.php";

/**
 * Descreva aqui a classe ClientePDO
 *
 * @author vagner
 */
class ClientePDO extends Conexao{
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($cliente){
        try{
            $stmt = $this->conn->prepare("INSERT INTO clientes "
                . "(nome, sobrenome, situacao) "
                . "VALUES (?, ?, ?)");
            $stmt->bindValue(1, $cliente->getNome());
            $stmt->bindValue(2, $cliente->getSobrenome());
            $stmt->bindValue(3, $cliente->getSituacao());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ClientePDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($cliente){
        try{
            $stmt = $this->conn->prepare("UPDATE clientes SET nome=?, sobrenome=?, "
                    . "situacao=? WHERE id = ?");
            $stmt->bindValue(1, $cliente->getNome());
            $stmt->bindValue(2, $cliente->getSobrenome());
            $stmt->bindValue(3, $cliente->getSituacao());
            $stmt->bindValue(4, $cliente->getId());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ClientePDO->update: " . $ex->getMessage();
            return false;
        }
    }

    public function deleteSoft($id){
        try{
            $stmt = $this->conn->prepare("UPDATE clientes SET situacao=? WHERE id=?");
            $stmt->bindValue(1, false);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ClientePDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function reativarClientePeloId($id){
        try{
            $stmt = $this->conn->prepare("UPDATE clientes SET situacao=? WHERE id=?");
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ClientePDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }

    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM vendas.clientes ORDER BY nome");
            if($stmt->execute()){
                $clientes = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($clientes, $this->resultSetToCliente($rs));
            }
            
            return $clientes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ClientePDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    
    public function findAllWithoutDeleted(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM vendas.clientes WHERE situacao = ? ORDER BY nome");
            $stmt->bindValue(1, true);
            if($stmt->execute()){
                $clientes = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($clientes, $this->resultSetToCliente($rs));
            }
            
            return $clientes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ClientePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findByNome($nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE nome LIKE ? ORDER BY nome");
            $stmt->bindValue(1, $nome . '%');
            if ($stmt->execute()) {
                $clientes = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($clientes, $this->resultSetToCliente($rs));
                }
                return $clientes;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe ClientePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToCliente($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe ClientePDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToCliente($rs){
        $cliente = new Cliente();
        $cliente->setId($rs->id);
        $cliente->setNome($rs->nome);
        $cliente->setSobrenome($rs->sobrenome);
        $cliente->setSituacao($rs->situacao);
        
        return $cliente;
    }

}
