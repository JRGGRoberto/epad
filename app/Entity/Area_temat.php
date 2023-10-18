<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Area_temat{

  public $id;
  public $nome;


  /**
 * @param $id identificador do projeto
 * @return @array
 */
  public static function getRegistros($id = -1){
    $sql = "
      select 
        a1.id, a1.nome, 
        if(IFNULL(p.id, 'a') != 'a', 'SELECTED', '') sel
      from 
        area_tematica a1
        left join projetos p 
          on 
            p.area_tema1  = a1.id 
          and 
            (p.id, p.ver) = 
            (select id, max(ver) from projetos p2  where id = '" . $id ."')
      order by a1.nome";

    return (new Database('area_tematica'))->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Area2
   */
  public static function getRegistro($id){
    return (new Database('area_tematica'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

}