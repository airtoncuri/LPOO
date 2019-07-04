<?php

include_once "../model/Copia.php";
include_once "../pdo/CopiaPDO.php";

class Controller{
    private $CopiaPDO;
    
    public function __construct() {
        $this->copiaPDO = new CopiaPDO();
    }
    
    public function exibeMenu(){
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Copia ---------";
            echo "\n1. Inserir Copia";
            echo "\n2. Alterar Copia";
            echo "\n3. Excluir Copia (soft delete)";
            echo "\n4. Listar todas as copias";
            echo "\n5. Listar copias pelo titulo";
            echo "\n6. Listar copias pelo código";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirCopia();
                    break;
                case 2:
                    $this->alterarCopia();
                    break;
                case 3:
                    $this->excluirCopia();
                    break;
                case 4:
                    $this->listarTodasCopias();
                    break;
                case 5:
                    $this->listarCopiasPeloNome();
                    break;
                case 6:
                    $this->listarCopiasPeloCodigo();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    private function inserirCopia(){
        $copia = new Copia();
        echo"\nTitulo da Copia: ";
        $copia->setTitulo(rtrim(fgets(STDIN)));
        echo"\nData da Copia: ";
        $copia->setDataCopia(rtrim(fgets(STDIN)));
        $copia->setSituacao(true); 
    
        if($this->copiaPDO->insert($copia)){
            echo "\nCopia salva.";
        }else{
            echo "\nErro ao salvar copia!!";
        }
    }
    
    private function alterarCopia(){
        echo "\nDigite o código da copia que você deseja alterar: ";
        $copia = $this->copiaPDO->findByIdCopia(rtrim(fgets(STDIN)));
        if($copia != null){
            print_r($copia);
            echo "\nDigite o titulo da copia: ";
            $titulo = fgets(STDIN);
            if($titulo != "\n"){
                $copia->setTitulo(rtrim($titulo));
            }
            echo"\nInforme a Data da Copia: ";
            $dataCopia = fgets(STDIN);
            if($dataCopia != "\n"){
                $copia->setTitulo(rtrim($dataCopia));
            }
           
            if($this->copiaPDO->update($copia)){
                echo "\nCopia alterada.";
            }else{
                echo "\nErro ao alterar a cópia!!";
            }
        }else{
            echo "\nNão há cópias cadastradas com esse código.";
        }
    }
    
    private function excluirCopia(){
        echo "\nDigite o código da copia que você quer excluir: ";
        $copia = $this->copiaPDO->findById(rtrim(fgets(STDIN)));
        print_r($copia);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->copiaPDO->deleteSoft($copia->getIdCopia())){
                echo "\nCopia excluída.";
            }else{
                echo "\nFalha ao reativar a cópia!!";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    private function listarTodasCopias(){
        print_r($this->copiasPDO->findAll());
    }
    
    private function listarCopiasPeloTitulo(){
        echo "\nDigite o nome do título da cópia para pesquisa: ";
        $titulo = rtrim(fgets(STDIN));   
        print_r($this->copiaPDO->findByTitulo($titulo));
    }
    
    private function listarCopiasPeloCodigo(){
        echo "\nDigite o código da cópia para pesquisa: ";
        $idCopia = rtrim(fgets(STDIN));
        print_r($this->copiaPDO->findByIdCopia($idCopia));
    }
    
    //update (case 7)
    private function reativarCopiaPeloCodigo(){
        echo "\nDigite o código da cópia que você deseja reativar: ";
        $copia = $this->copiaPDO->findById(rtrim(fgets(STDIN)));
        print_r($copia);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->copiaPDO->reativarCopiaPeloId($copia->getIdCopia())){
                echo "\nCopia reativada.";
            }else{
                echo "\nFalha ao reativar a cópia!!";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }   
    }
        
    
}
   
    



