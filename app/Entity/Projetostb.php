<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Projetostb{

   /**
   * Identificador único 
   * @var string
   */
  public $id;

  /**
   * versão
   * @var int
   */
  public $versao;
  
  /**
   * coordenador
   * @var string
   */
  public $coordenador;

  /**
   * titulo
   * @var string
   */
  public $titulo;

  /**
   * campus
   * @var string
   */
  public $campus;


  /**
   * ano
   * @var string
   */
  public $ano;


  /**
   * arq_projeto
   * @var string
   */
  public $arq_projeto;

  /**
   * arq_relatorio
   * @var string
   */
  public $arq_relatorio;

  

  /**
   * Método responsável por obter os dados dos projetos do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getList($where = null, $order = null, $limit = null){
    $order = 'coordenador';
    return (new Database('projetostb'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('projetostb'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }


  /**
   * Método responsável por buscar uma vaga com base em seu ID
   * @param  integer $id
   * @return Projetostb
   */
  public static function get($id){
    return (new Database('projetostb'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }

}
