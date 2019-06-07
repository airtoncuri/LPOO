<?php

include_once "../model/Produto.php";
include_once "../pdo/ProdutoPDO.php";

class ProdutoController{
    private $produtoPDO;
    
    public function __construct() {
        $this->produtoPDO = new ProdutoPDO();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Produto ---------";
            echo "\n1. Inserir Produto";
            echo "\n2. Alterar Produto";
            echo "\n3. Excluir Produto (soft delete)";
            echo "\n4. Listar todos os produtos";
            echo "\n5. Listar produtos pelo nome";
            echo "\n6. Listar produto pelo código";
            echo "\n7. Reativar produto pelo código";

            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirProduto();
                    break;
                case 2:
                    $this->alterarProduto();
                    break;
                case 3:
                    $this->excluirProduto();
                    break;
                case 4:
                    $this->listarTodosProdutos();
                    break;
                case 5:
                    $this->listarProdutosPeloNome();
                    break;
                case 6:
                    $this->listarProdutosPeloCodigo();
                    break;
                case 7:
                    $this->reativarProdutoPeloCodigo();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    //insert (case 1)
    private function inserirProduto(){
        $produto = new Produto();
        echo"\nNome do Produto: ";
        $produto->setNome(rtrim(fgets(STDIN)));
        echo"\nDescrição do Produto: ";
        $produto->setDescricao(rtrim(fgets(STDIN)));
        echo"\nValor do Produto (sistema americano): ";
        $produto->setValor(rtrim(fgets(STDIN)));
        $produto->setSituacao(true); //nasce como registro válido no bd
        echo"\nQuantidade em estoque: ";
        $produto->setQuantidade(rtrim(fgets(STDIN)));
        if($this->produtoPDO->insert($produto)){
            echo "\nProduto salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarProduto(){
        echo "\nDigite o código do produto que você deseja alterar: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        if($produto != null){
            print_r($produto);
            echo "\nDigite o nome do produto: ";
            $nome = fgets(STDIN);
            if($nome != "\n"){
                $produto->setNome(rtrim($nome));
            }
            echo"\nDescrição do Produto: ";
            $descricao = fgets(STDIN);
            if($descricao != "\n"){
                $produto->setDescricao(rtrim($descricao));
            }
            echo"\nValor do Produto (sistema americano): ";
            $valor = fgets(STDIN);
            if($valor != "\n"){
                $produto->setValor(rtrim($valor));
            }
            echo"\nQuantidade em estoque: ";
            $quantidade = fgets(STDIN);
            if($quantidade != "\n"){
                $produto->setQuantidade(rtrim($quantidade));
            }
            if($this->produtoPDO->update($produto)){
                echo "\nProduto alterado.";
            }else{
                echo "\nErro ao alterar o produto. Contate o administrador do sistema.";
            }
        }else{
            echo "\nNão há produtos cadastrados com esse código.";
        }
    }
    
    //update (case 3)
    private function excluirProduto(){
        echo "\nDigite o código do produto que você deseja tornar inativo: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->produtoPDO->deleteSoft($produto->getId())){
                echo "\nProduto excluído.";
            }else{
                echo "\nFalha ao reativar o produto. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    //findAll ou SELECT sem filtros (case 4)
    private function listarTodosProdutos(){
        print_r($this->produtoPDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarProdutosPeloNome(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->produtoPDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarProdutosPeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->produtoPDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarProdutoPeloCodigo(){
        echo "\nDigite o código do produto que você deseja reativar: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->produtoPDO->reativarProdutoPeloId($produto->getId())){
                echo "\nProduto reativado.";
            }else{
                echo "\nFalha ao reativar o produto. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }   
    }
        
    
}
   
    



