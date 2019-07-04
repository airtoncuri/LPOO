<?php

class Locacao {
    private $dataLoc;
    private $dataDev;
    private $valorLoc;
    private $situacao;
    private $socio; //associa com a classe socio
    private $itemLocacao; //associa com a classe itemLocacao
    
    public function __construct (){
       
    }
    
    public function getDataLoc(){
        return $this->dataLoc;
    }
    
    public function getDataDev(){
        return $this->dataDev;
    }
    
    public function getValorLoc(){
        return $this->valorLoc;
    }
    
    public function getSituacao(){
        return $this->situacao;
    }
    
    public function getSocio(){
        return $this->socio;
    }
    
    public function getItemLocacao(){
        return $this->itemLocacao;
    }
    
    public function setDataLoc($dataLoc){
        $this->dataLoc = $dataLoc;
    }
    
    public function setDataDev($dataDev){
        $this->dataDev = $dataDev;
    }
    
    public function setValorLoc($valorLoc){
        $this->valorLoc = $valorLoc;
    }
    
    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }
    
    public function setSocio($socio){
        $this->socio = $socio;
    }
    
    public function setItemLocacao($itemLocacao){
        $this->itemLocacao = $itemLocacao;
    }
    
    public function __toString() {
        return "\Locacao[dataLoc=$this->dataLoc, dataDev=$this->dataDev, valorLoc=$this->valorLoc, situacao=$this->situacao, " . print_r() . "]";
    }
    
    
}

