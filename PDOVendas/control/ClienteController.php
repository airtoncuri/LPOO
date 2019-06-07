<?php

include_once "../pdo/ClientePDO.php";

/**
 * Descreva aqui a classe ClienteController
 *
 * @author vagner
 */
class ClienteController {
    
    private $clientePDO;
    
    public function __construct() {
        $this->clientePDO = new ClientePDO();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Cliente ---------";
            echo "\n1. Inserir Cliente";
            echo "\n2. Alterar Cliente";
            echo "\n3. Excluir Cliente (soft delete)";
            echo "\n4. Listar todos os clientes";
            echo "\n5. Listar clientes pelo nome";
            echo "\n6. Listar cliente pelo código";
            echo "\n7. Reativar cliente pelo código";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirCliente();
                    break;
                case 2:
                    $this->alterarCliente();
                    break;
                case 3:
                    $this->excluirCliente();
                    break;
                case 4:
                    $this->listarTodosClientes();
                    break;
                case 5:
                    $this->listarClientesPeloNome();
                    break;
                case 6:
                    $this->listarClientePeloCodigo();
                    break;
                case 7:
                    $this->reativarClientePeloCodigo();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    //insert (case 1)
    private function inserirCliente(){
        $cliente = new Cliente();
        echo"\nNome do Cliente: ";
        $cliente->setNome(rtrim(fgets(STDIN)));
        echo"\nSobrenome do Cliente: ";
        $cliente->setSobrenome(rtrim(fgets(STDIN)));
        $cliente->setSituacao(true); //nasce como registro válido no bd
        if($this->clientePDO->insert($cliente)){
            echo "\nCliente salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarCliente(){
        echo "\nDigite o código do cliente que você deseja alterar: ";
        $cliente = $this->clientePDO->findById(rtrim(fgets(STDIN)));
        if($cliente != null){
            print_r($cliente);
            echo "\nDigite o nome do cliente: ";
            $nome = fgets(STDIN);
            if($nome != "\n"){
                $cliente->setNome(rtrim($nome));
            }
            echo"\nSobrenome do Cliente: ";
            $descricao = fgets(STDIN);
            if($descricao != "\n"){
                $cliente->setSobrenome(rtrim($descricao));
            }
            if($this->clientePDO->update($cliente)){
                echo "\nCliente alterado.";
            }else{
                echo "\nErro ao alterar o cliente. Contate o administrador do sistema.";
            }
        }else{
            echo "\nNão há clientes cadastrados com esse código.";
        }
    }
    
    //update (case 3)
    private function excluirCliente(){
        echo "\nDigite o código do cliente que você deseja tornar inativo: ";
        $cliente = $this->clientePDO->findById(rtrim(fgets(STDIN)));
        print_r($cliente);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->clientePDO->deleteSoft($cliente->getId())){
                echo "\nCliente excluído.";
            }else{
                echo "\nFalha ao reativar o cliente. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    //findAll ou SELECT sem filtros (case 4)
    private function listarTodosClientes(){
        print_r($this->clientePDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarClientesPeloNome(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->clientePDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarClientePeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->clientePDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarClientePeloCodigo(){
        echo "\nDigite o código do cliente que você deseja reativar: ";
        $cliente = $this->clientePDO->findById(rtrim(fgets(STDIN)));
        print_r($cliente);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->clientePDO->reativarClientePeloId($cliente->getId())){
                echo "\nCliente reativado.";
            }else{
                echo "\nFalha ao reativar o cliente. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }  
    }
}
