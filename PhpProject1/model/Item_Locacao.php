<?php

class Item_Locacao {
    private $registrar;
    
    
   public function __construct(){
       
   }
   
   public function getRegistrar(){
       return $this->registrar;
   }
   
   public function setRegistrar ($registrar){
       $this->registrar = $registrar;
   }
}