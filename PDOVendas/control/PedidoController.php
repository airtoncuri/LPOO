<?php

include_once "../model/ItemPedido.php";

include_once "../model/Pedido.php";

include_once "../pdo/ItemPedidoPDO.php";

include_once "../pdo/ProdutoPDO.php";

include_once "../pdo/ClientePDO.php";

include_once "../model/Pedido.php";

include_once "../pdo/PedidoPDO.php";

/**
 * Descreva aqui a classe PedidoController
 *
 * @author vagner
 */
class PedidoController {
    
    private $pedidoPDO;
    private $clientePDO;
    private $produtoPDO;

    public function __construct() {
        $this->pedidoPDO = new PedidoPDO();
        $this->clientePDO = new ClientePDO();
        $this->produtoPDO = new ProdutoPDO();
    }
    
    public function exibeMenu(){
         //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Pedido ---------";
                echo "\n1. Vender (inserir pedido): ";
                echo "\n2. Faturar Pedido (alterar pedido): ";
                echo "\n3. Entregar Pedido (alterar pedido): ";
                echo "\n4. Excluir Pedido (soft delete): ";
                echo "\n5. Listar todos os pedidos: ";
                echo "\n6. Listar pedidos por cliente: ";
                echo "\n7. Listar pedido pelo código: ";
                echo "\nOpção (ZERO para sair): "; 
                $exit = fgets(STDIN);
                switch ($exit){
                    case 0:
                        break;
                    case 1:
                        $this->vender();
                        break;
                    case 2:
                        $this->faturarPedido();
                        break;
                    case 3:
                        $this->entregarPedido();
                        break;
                    case 4:
                        $this->excluirPedido();
                        break;
                    case 5:
                        $this->listarTodosPedidos();
                        break;
                    case 6:
                        $this->listarPedidoPorCliente();
                        break;
                    case 7:
                        $this->listarPedidoPorId();
                        break;
                    default:
                        echo "\nOpção inexistente.";
                }
        } //fim Menu
    }
    
    private function vender(){
        $itens = Array();
        $totalPedido = 0;
        echo "\nSelecione o cliente na lista abaixo digitando seu código";
        $clientes = $this->clientePDO->findAllWithoutDeleted();
        if($clientes != null){
            echo "\nLista de clientes cadastrados\n";
            print_r($clientes);
            echo "\nCódigo do cliente: ";
            $cliente = null;
            while($cliente == null){
                $id = rtrim(fgets(STDIN));
                $cliente = $this->clientePDO->findById($id);
                if($cliente != null){
                    echo "\nCliente " . $cliente->getNome() . " " . $cliente->getSobrenome() . " " . $cliente->getId() . " selecionado.";
                }else{
                    echo "\nNão foi possível selecionar este cliente. Tente novamente.";
                }
            }
            $exit = -1;
            while($exit != 0){
                echo "\nSelecione o produto para venda na lista abaixo digitando seu código";
                $produtos = $this->produtoPDO->findAllWithoutDeleted();
                if($produtos != null && $exit != 0){
                    echo "\nLista de produtos cadastrados\n";
                    print_r($produtos);
                    echo "\nCódigo do produto: ";
                    $produto = null;
                    while($produto == null){
                        $id = rtrim(fgets(STDIN));
                        $produto = $this->produtoPDO->findById($id);
                        if($produto != null && $produto->getSituacao()){
                            echo "Produto " . $produto->getNome() . ", código = " . $produto->getId() . " selecionado.";
                            $item = new ItemPedido($produto);
                            echo "\nDigite a quantidade (no limite do estoque): ";
                            $quantidade = 0;
                            while($quantidade == 0){
                                $quantidade = rtrim(fgets(STDIN));
                                if($quantidade > $produto->getQuantidade() || $quantidade < 1){
                                    echo "\nDigite uma quantidade dentro do limite do estoque ou válida.";
                                    $quantidade = 0;
                                }else{
                                    $item->setQuantidade($quantidade);
                                }
                            }
                            $item->setTotalItem($quantidade * $produto->getValor());
                            $totalPedido += $item->getTotalItem();
                            array_push($itens, $item);
                        }else{
                            echo "\nNão foi possível selecionar este produto. Tente novamente.";
                        }
                    }
                }
                echo "\nVender mais produtos? (0 para sair)";
                $exit = rtrim(fgets(STDIN));
            }
            if(sizeof($itens) > 0){
                $pedido = new Pedido($itens);
                $pedido->setCliente($cliente);
                $pedido->setTotalPedido($totalPedido);
                $pedido->setFormaPagamento('dinheiro');
                if($this->pedidoPDO->insert($pedido)){ //salva o pedido
                    echo "\nPedido salvo.";
                }else{
                    echo "\nNão foi possível salvar este pedido.";
                }
            }else{
                echo "\nNenhum pedido foi emitido.";
            }

        }
    }
    
    private function faturarPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function entregarPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function excluirPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarTodosPedidos(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarPedidoPorCliente(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarPedidoPorId(){
        echo "\nEm desenvolvimento.";   
    }
    
}//fim class
