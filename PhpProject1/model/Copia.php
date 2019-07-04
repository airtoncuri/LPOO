<?php




class Copia {
    private $numCopia;
    private $dataCopia;
    private $titulo;
    
    
  public function __construct ($titulo){
    $this -> titulo = $titulo;
}

  
  public function getNumCopia (){
      return $this->numCopia;
  }
  
  public function getDataCopia (){
      return $this->dataCopia;
  }
  
  public function setNumCopia($numCopia){
      $this->numCopia = $numCopia;
  }
  
  public function setDataCopia($dataCopia){
      $this->dataCopia = $dataCopia;
  }
  
  public function __toString() {
        return "\Copia[numCopia=$this->numCopia, dataCopia=$this->dataCopia" . print_r() . "]";
    }
}



