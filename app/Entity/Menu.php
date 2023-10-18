<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Menu{

  public $id;
  public $path;
  public $titulo;
  public $img;
  public $descr;
  public $ativo;
  
  /**
   * Método responsável por obter as registros do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getRegistros($where = null, $order = null, $limit = null){
    return (new Database('menu1'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar uma Pessoa com base em seu ID
   * @param  integer $id
   * @return Pessoa
   */
  public static function getRegistro($id){
    return (new Database('menu1'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}