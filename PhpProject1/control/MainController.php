<?php

include_once "FilmeController.php";

include_once "LocacaoController.php";

include_once "SocioController.php";

include_once "Item_LocacaoController.php";

/**
 * Descreva aqui a classe MainController
 *
 * @author airton
 */
class mainController {
    
    private $filmeController;
    private $locacaoController;
    private $socioController;
    private $item_LocacaoController;
    
    public function __construct() {
    $this->filmeController = new FilmeController();
    $this->locacaoController = new LocacaoController();
    $this->socioController = new SocioController();
    $this->item_LocacaoController = new Item_LocacaoController();
        }
    
    public function exibirMenu(){
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Menu ---------";
            echo "\n1. Manter Filme";
            echo "\n2. Manter Locacao";
            echo "\n3. Manter Socio";
            echo "\n4. Manter Item de Locacao";
            echo "\nOpção (ZERO para sair): ";
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->filmeController->exibeMenu();
                    break;
                case 2:
                    $this->locacaoController->exibeMenu();
                    break;
                case 3:
                    $this->socioController->exibeMenu();
                    break;
                case 4:
                    $this->locacaoController->exibeMenu();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        }
    }
        
}


$mainController = new MainController();
$mainController->exibeMenu();
