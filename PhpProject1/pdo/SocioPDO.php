<?php

include_once "../model/Socio.php";

include_once "Conexao.php";

/**
 * Descreva aqui a classe SocioPDO
 *
 * @author airton
 */
class SocioPDO extends Conexao {
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($socio){
        try{
            $stmt = $this->conn->prepare("INSERT INTO socio "
                . "(nome, endereco, telefone, situacao, locacao) "
                . "VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $socio->getNome());
            $stmt->bindValue(2, $socio->getEndereco());
            $stmt->bindValue(3, $socio->getTelefone());
            $stmt->bindValue(4, $socio->getSituacao());
            $stmt->bindValue(5, $socio->getLocacao());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SocioPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($socio){
        try{
            $stmt = $this->conn->prepare("UPDATE socio SET nome=?, descricao=?, "
                    . "valor=?, situacao=?, quantidade=? WHERE id = ?");
            $stmt->bindValue(1, $socio->getNome());
            $stmt->bindValue(2, $socio->getEndereco());
            $stmt->bindValue(3, $socio->getTelefone());
            $stmt->bindValue(4, $socio->getSituacao());
            $stmt->bindValue(5, $socio->getLocacao());
            $stmt->bindValue(6, $socio->getId());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SocioPDO->update: " . $ex->getMessage();
            return false;
        }
    }

    public function deleteSoft($id){
        try{
            $stmt = $this->conn->prepare("UPDATE socio SET situacao=? WHERE id=?");
            $stmt->bindValue(1, false);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SocioPDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function reativarSocioPeloId($id){
        try{
            $stmt = $this->conn->prepare("UPDATE socio SET situacao=? WHERE id=?");
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em SocioPDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM locacao.socio ORDER BY nome");
            if($stmt->execute()){
                $socio = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($socio, $this->resultSetToSocio($rs));
            }
            
            return $socio;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe SocioPDO: " . $ex->getMessage();
            return null;    
        }     
    }
    
    public function findAllWithoutDeleted(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM locacao.socio WHERE situacao = ? ORDER BY nome");
            $stmt->bindValue(1, true);
            if($stmt->execute()){
                $socio = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($socio, $this->resultSetToSocio($rs));
            }
            
            return $socio;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe SocioPDO: " . $ex->getMessage();
            return null;    
        }
    }

    public function findByNome($nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM socio WHERE nome LIKE ? ORDER BY nome");
            $stmt->bindValue(1, $nome . '%');
            if ($stmt->execute()) {
                $socio = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($socio, $this->resultSetToSocio($rs));
                }
                return $socio;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe SocioPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM socio WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToSocio($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe SocioPDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToSocio($rs){
        $socio = new Socio();
        $socio->setId($rs->id);
        $socio->setNome($rs->nome);
        $socio->setEndereco($rs->endereco);
        $socio->setTelefone($rs->telefone);
        $socio->setSituacao($rs->situacao);
        $socio->setLocacao($rs->locacao);
        
        return $socio;
    }
    
}
