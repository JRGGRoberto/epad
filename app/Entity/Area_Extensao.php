<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

/**
 * @param $id identificador do projeto
 * @return @array
 */
class Area_Extensao{

  public $id;
  public $nome;
  
  public static function getRegistros($id = -1){
    $sql = 
    "select 
        a1.id, a1.nome, 
        if(IFNULL(p.id, 'a') != 'a', 'SELECTED', '') sel
      from 
        area_extensao a1
        left join projetos p 
          on 
            p.area_tema1  = a1.id 
          and 
            (p.id, p.ver) = 
            (select id, max(ver) from projetos p2  where id = '" . $id ."')";

    return (new Database('area_extensao'))->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Area1
   */
  public static function getRegistro($id){
    return (new Database('area_extensao'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}


