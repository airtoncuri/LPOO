<?php

include_once "../model/Filme.php";

include_once "Conexao.php";

/**
 * Descreva aqui a classe FilmePDO
 *
 * @author airton
 */
class FilmePDO extends Conexao {
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($filme){
        try{
            $stmt = $this->conn->prepare("INSERT INTO filme "
                . "(titulo, duracaoFilme, id) "
                . "VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDuracaoFilme());
            $stmt->bindValue(3, $filme->getIdFilme());

            
        } catch (PDOException $ex) {
            echo "\nExceção em FilmePDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($filme){
        try{
            $stmt = $this->conn->prepare("UPDATE filme SET titulo=?, duracaoFilme=?, "
                    . "WHERE id = ?");
            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDuracaoFilme());
            $stmt->bindValue(3, $filme->getIdFilme());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em FilmePDO->update: " . $ex->getMessage();
            return false;
        }
    }

 
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM locadora.titulo ORDER BY nome");
            if($stmt->execute()){
                $filme = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($filme, $this->resultSetToFilme($rs));
            }
            
            return $filme;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe FilmePDO: " . $ex->getMessage();
            return null;    
        }     
    }
    
   
    public function findByTitulo($titulo){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM filme WHERE titulo LIKE ? ORDER BY titulo");
            $stmt->bindValue(1, $titulo . '%');
            if ($stmt->execute()) {
                $filme = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($filme, $this->resultSetToFilme($rs));
                }
                return $filme;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe FilmePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM filme WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToFilme($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe FilmePDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToFilme($rs){
        $filme = new Filme();
        $filme->setId($rs->id);
        $filme->setTitulo($rs->titulo);
        $filme->setDuracaoFilme($rs->duracaoFilme);
        
        return $filme;
    }
    
}
