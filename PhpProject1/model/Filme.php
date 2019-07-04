<?php

class Filme {
    private $titulo;
    private $duracaoFilme;
    private $idFilme;


public function __construct (){
    
}

public function getTitulo (){
    return $this->getTitulo;
}

public function getDuracaoFilme(){
    return $this->duracaoFilme;
}

public function getIdFilme(){
    return $this->idFilme;
}

public function setTitulo($titulo){
    $this->titulo=$titulo;
}

public function setDuracaoFilme($duracaoFilme){
    $this->duracaoFilme=$duracaoFilme;
}

public function setIdFilme ($idFilme){
    $this->idFilme= $idFilme;
}

public function __toString() {
        return "\Filme[titulo=$this->titulo, duracaoFilme=$this->duracaoFilme]";
    }

}

