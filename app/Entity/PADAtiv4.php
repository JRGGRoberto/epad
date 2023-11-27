<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class PADAtiv3 {
  public $id;
  public $vinculo;
  public $atividade;
  public $cargo;
  public $alocado;
  public $numdata;
  public $ch;
  public $created_at;
  public $updated_at;
  public $user;

  public function add(){
    $obDb = new Database('pad4');
    $newId = exec('uuidgen -r');
    $obDb->insert([
        'id'         => $newId,
        'vinculo'    => $this->vinculo,
        'atividade'  => $this->atividade,
        'cargo'      => $this->cargo,
        'alocado'    => $this->alocado,
        'numdata'    => $this->numdata,
        'ch'         => $this->ch,
        'created_at' => $this->created_at,
      //'updated_at' => $this->updated_at,
        'user'       => $this->user
    ]);
    return $newId;
  }


  public function atualizar(){
    return ( new Database('pad4'))->update('id = "'.$this->id.'" ', [
       // 'vinculo'     => $this->vinculo,
        'atividade'  => $this->atividade,
        'cargo'      => $this->cargo,
        'alocado'    => $this->alocado,
        'numdata'    => $this->numdata,
        'ch'         => $this->ch,
        'updated_at' => date("Y-m-d H:i:s"),
        'user'       => $this->user
    ]);
  }

  public static function get($where = null, $order = null, $limit = null){
    return (new Database('pad4'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  } 

  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('pad4'))->select($where)
                                     ->fetchObject(self::class);
  }


  public static function getQntd($where = null){
    return (new Database('pad4'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }


}