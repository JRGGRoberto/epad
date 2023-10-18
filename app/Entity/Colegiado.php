<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Colegiado{

  public $id;
  public $nome;
  public $coord_id;
  public $centro_id;
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
    return (new Database('colegiados'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('colegiados'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
  
  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Colegiado
   */
  public static function getRegistro($id){
    return (new Database('colegiados'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por excluir a Registro do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('colegiados'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */

  public function atualizar(){
    return (new Database('colegiados'))->update('id = "'.$this->id.'" ',[
                                                                 'nome'       => $this->nome,
                                                                 'coord_id'   => $this->coord_id,
                                                                 'centro_id'  => $this->centro_id,
                                                                 'updated_at' => date("Y-m-d H:i:s"),
                                                                 'user'       => $this->user
                                                              ]);
  }



  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
    // $this->data = date('Y-m-d H:i:s');
    $obDatabase = new Database('colegiados');
    $this->id = $obDatabase->insert([
                                      'nome'    => $this->nome,
                                      'coord_id' => $this->centro_id,
                                      'nome' => $this->nome,
                                    //  'updated_at' => date("Y-m-d H:i:s"),
                                      'user' => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }


  /**
 * @param $id identificador do projeto
 * @return @array
 */
public static function getRegistrosSelect($id = -1, $co = -1){
  $sql = "
        select 
          ccc.co_id id, ccc.colegiado nome,
          if(IFNULL(p.id, 'a') != 'a', 'SELECTED', '') sel
        from 
          ca_ce_co ccc 
          left join projetos p 
            on p.para_avaliar  = ccc.co_id 
            and (p.id, p.ver) = 
                (select p2.id, max(p2.ver) from projetos p2  where p2.id = '" . $id ."')
        where ccc.ca_id  = (
           select  c.ca_id 
           from ca_ce_co c 
           where c.co_id  = '" . $co ."')";

  return (new Database('area_tematica'))->selectJ($sql)
    ->fetchAll(PDO::FETCH_CLASS,self::class);
}


}