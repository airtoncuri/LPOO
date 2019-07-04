<?php

include_once "SocioController.php";

/**
 * Descreva aqui a classe MainController
 *
 * @author airton
 */
class MainController {
    
    private $socioController;
    
    public function __construct() {
    $this->socioController = new SocioController();
   
        }
    
    public function exibirMenu(){
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Menu ---------";
            echo "\n1. Manter Socio";
            echo "\nOpção (ZERO para sair): ";
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->socioController->exibeMenu();
                default:
                    echo "\nOpção inexistente.";
            }
        }
    }
        
}



$mainController = new MainController();
$mainController->exibeMenu();
