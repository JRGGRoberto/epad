<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class CnpqArea{

  public $id;
  public $id_garea;
  public $id_avalia;
  public $nome;
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
  public static function getRegistros($where = null, $order = null, $limit = null){
    return (new Database('cnpq_area'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('cnpq_area'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return CnpqArea
   */
  public static function getRegistro($id){
        return (new Database('cnpq_area'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }


  
}