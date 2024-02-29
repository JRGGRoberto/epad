<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
// use \App\Entity\UuiuD;

class Suporte{

  public $id;
  public $created_at;
  public $updated_at;
  public $user;

  
  
  /**
   * Método responsável por obter as registros do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function get($where = null, $order = null, $limit = null){
    return (new Database('suporte'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


}