<?php

namespace App\Db;

class Pagination{

  /**
   * Número máximo de registro por páginas
   * @var integer
   */
  private $limit;

  /**
   * Quantidade total de resultados de banco
   * @var integer
   */
  private $results;

  /**
   * Quantidade de páginas
   * @var integer
   */
  private $pages;

  /**
   * Página atual
   * @var integer
   */
  private $currentPage;

  /**
   * Construtor da classe
   * @param integer $results
   * @param integer $currentPage
   * @param integer $limit
   */
  public function __construct($results, $currentPage, $limit = 10){
    $this->results = $results;
    $this->limit   = $limit;
    $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
    $this->calculate();
  }

  /**
   * Método responsável por calcular a páginação
   */
  private function calculate(){
    //Calcula o total de páginas
    $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

    //Verifica se a página atual não exede o número de páginas
    $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
  }

  /**
   * Método responsável por retornar a cláusua limit do SQL
   */
  public function getLimite(){
    $offset = ($this->limit *($this->currentPage -1));
    return $offset.','.$this->limit;
  }

  /**
   * Método responsável por retornar as opções de páginas disponíveis
   * @return array
   */
  public function getPages(){
    //Não retornar paginas
    if($this->pages == 1) return [];

    //Páginas
    $paginas = [];
    for($i =1; $i <= $this->pages; $i++){
      $paginas[] = [
        'pagina' => $i,
        'atual' => $i == $this->currentPage
      ];
    }
    return $paginas;
  }

}