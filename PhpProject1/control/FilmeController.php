<?php

include_once "../model/Filme.php";
include_once "../pdo/FilmePDO.php";

class FilmeController{
    private $FilmePDO;
    
    public function __construct() {
        $this->filmePDO = new FilmePDO();
    }
    
    public function exibeMenu(){
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Filme ---------";
            echo "\n1. Inserir Filme";
            echo "\n2. Alterar Filme";
            echo "\n3. Listar todos os filmes";
            echo "\n4. Listar filmes pelo titulo";
            echo "\n5. Listar filmes pelo código";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirFilme();
                    break;
                case 2:
                    $this->alterarFilme();
                    break;
                case 3:
                    $this->listarTodosFilmes();
                    break;
                case 4:
                    $this->listarFilmePeloTitulo();
                    break;
                case 5:
                    $this->listarFilmePeloCodigo();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    private function inserirFilme(){
        $filme = new filme();
        echo"\nNome do Filme: ";
        $filme->setTitulo(rtrim(fgets(STDIN)));
        echo"\nDuração do Filme: ";
        $filme->setDuracao(rtrim(fgets(STDIN)));
    
        if($this->filmePDO->insert($filme)){
            echo "\nFilme salvo.";
        }else{
            echo "\nErro ao salvar filme!!";
        }
    }
    
    private function alterarFilme(){
        echo "\nDigite o código do filme que você deseja alterar: ";
        $filme = $this->filmePDO->findById(rtrim(fgets(STDIN)));
        if($filme != null){
            print_r($filme);
            echo "\nDigite o nome do filme: ";
            $titulo = fgets(STDIN);
            if($titulo != "\n"){
                $filme->setTitulo(rtrim($titulo));
            }
            echo"\nDuração do Filme: ";
            $duracao = fgets(STDIN);
            if($duracao != "\n"){
                $duracao->setDuracao(rtrim($duracao));
            }
          
            if($this->filmePDO->update($filme)){
                echo "\nFilme alterado com sucesso!!";
            }else{
                echo "\nErro ao alterar o filme!!";
            }
        }else{
            echo "\nNão há filmes cadastrados com esse código.";
        }
    }
    
   
    private function listarTodosFilmes(){
        print_r($this->filmePDO->findAll());
    }
    
    private function listarFilmePeloNome(){
        echo "\nDigite o nome do filme para pesquisa: ";
        $titulo = rtrim(fgets(STDIN));   
        print_r($this->filmePDO->findByNome($titulo));
    }
    
    private function listarFilmesPeloCodigo(){
        echo "\nDigite o código do filme para pesquisa: ";
        $idFilme = rtrim(fgets(STDIN));
        print_r($this->filmePDO->findById($idFilme));
    }
    
  
        
    
}
   
    



