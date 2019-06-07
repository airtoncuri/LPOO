<?php

include_once "ClienteController.php";

include_once "PedidoController.php";

include_once "ProdutoController.php";

/**
 * Descreva aqui a classe MainController
 *
 * @author vagner
 */
class MainController {
    
    private $produtoController;
    private $pedidoController;
    private $clienteController;
    
    public function __construct() {
        //cria todos os controllers
        $this->produtoController = new ProdutoController();
        $this->pedidoController = new PedidoController();
        $this->clienteController = new ClienteController();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Menu ---------";
            echo "\n1. Manter Pedido";
            echo "\n2. Manter Cliente";
            echo "\n3. Manter Produto";
            echo "\n4. Manter Item de Pedido";
            echo "\nOpção (ZERO para sair): ";
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->pedidoController->exibeMenu();
                    break;
                case 2:
                    $this->clienteController->exibeMenu();
                    break;
                case 3:
                    $this->produtoController->exibeMenu();
                    break;
                case 4:
                    echo "\nEm desenvolvimento.";
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        }
    }
        
}//fim class

//inicializa a app
$mainController = new MainController();
$mainController->exibeMenu();
