<?php

include_once "../model/Socio.php";
include_once "../pdo/SocioPDO.php";

class SocioController{
    private $SocioPDO;
    
    public function __construct() {
        $this->socioPDO = new SocioPDO();
    }
    
    public function exibeMenu(){
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Socio ---------";
            echo "\n1. Inserir Socio";
            echo "\n2. Alterar Socio";
            echo "\n3. Excluir Socio (soft delete)";
            echo "\n4. Listar todos os socios";
            echo "\n5. Listar socios pelo nome";
            echo "\n6. Listar socios pelo código";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirSocio();
                    break;
                case 2:
                    $this->alterarSocio();
                    break;
                case 3:
                    $this->excluirSocio();
                    break;
                case 4:
                    $this->listarTodosSocios();
                    break;
                case 5:
                    $this->listarSociosPeloNome();
                    break;
                case 6:
                    $this->listarSociosPeloCodigo();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    private function inserirSocio(){
        $socio = new Socio();
        echo"\nNome do Socio: ";
        $socio->setNome(rtrim(fgets(STDIN)));
        echo"\nEndereço do Socio: ";
        $socio->setEndereco(rtrim(fgets(STDIN)));
        echo"\nTelefone do Socio: ";
        $socio->setTelefone(rtrim(fgets(STDIN)));
        $socio->setSituacao(true); 
        echo"\nQuantidade de Locações: ";
        $socio->setLocacao(rtrim(fgets(STDIN)));
        if($this->socioPDO->insert($socio)){
            echo "\nSocio salvo.";
        }else{
            echo "\nErro ao salvar socio!!";
        }
    }
    
    private function alterarSocio(){
        echo "\nDigite o código do socio que você deseja alterar: ";
        $socio = $this->socioPDO->findById(rtrim(fgets(STDIN)));
        if($socio != null){
            print_r($socio);
            echo "\nDigite o nome do socio: ";
            $nome = fgets(STDIN);
            if($nome != "\n"){
                $socio->setNome(rtrim($nome));
            }
            echo"\nEndereço do Socio: ";
            $endereco = fgets(STDIN);
            if($endereco != "\n"){
                $endereco->setEndereco(rtrim($endereco));
            }
            echo"\nTelefone do Socio: ";
            $telefone = fgets(STDIN);
            if($telefone != "\n"){
                $socio->setEndereco(rtrim($endereco));
            }
            echo"\nQuantidade de Locações: ";
            $locacao = fgets(STDIN);
            if($locacao != "\n"){
                $socio->setLocacao(rtrim($locacao));
            }
            if($this->socioPDO->update($socio)){
                echo "\nSocio alterado.";
            }else{
                echo "\nErro ao alterar o sócio!!";
            }
        }else{
            echo "\nNão há sócios cadastrados com esse código.";
        }
    }
    
    private function excluirSocio(){
        echo "\nDigite o código do sócio que você quer excluir: ";
        $socio = $this->socioPDO->findById(rtrim(fgets(STDIN)));
        print_r($socio);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->socioPDO->deleteSoft($socio->getId())){
                echo "\nSócio excluído.";
            }else{
                echo "\nFalha ao reativar o sócio!!";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    private function listarTodosSocios(){
        print_r($this->socioPDO->findAll());
    }
    
    private function listarSociosPeloNome(){
        echo "\nDigite o nome do sócio para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->socioPDO->findByNome($nome));
    }
    
    private function listarSociosPeloCodigo(){
        echo "\nDigite o código do sócio para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->socioPDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarSocioPeloCodigo(){
        echo "\nDigite o código do sócio que você deseja reativar: ";
        $socio = $this->socioPDO->findById(rtrim(fgets(STDIN)));
        print_r($socio);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->socioPDO->reativarSocioPeloId($socio->getId())){
                echo "\nSocio reativado.";
            }else{
                echo "\nFalha ao reativar o sócio!!";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }   
    }
        
    
}
   
    



