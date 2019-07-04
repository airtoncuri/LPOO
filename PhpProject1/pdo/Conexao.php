<?php
class Conexao{
    
    protected function getConexao(){
        try {
            $conn = new PDO('pgsql:dbname=locadora;user=postgres;password=senha5;host=localhost');
            $conn->setAttribute(PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION); //define para que o PDO lance exceções na ocorrência de erros
//            print_r($conn);
//            print_r($conn->getAvailableDrivers());
            
            return $conn;
                    
        } catch (PDOException $ex) {
            echo $ex->getFile() . ' ### ' . $ex->getLine() . ' ### ' . $ex->getMessage() . ' ### ' . $ex->getCode();
        
            return null;
        }
    }
}


