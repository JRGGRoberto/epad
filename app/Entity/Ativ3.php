<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class Ativ21 {
  public $id;
  public $id_vin;
  public $tp;
  public $nome;
  public $func;
  public $num_ato;
  public $chs;
  public $created_at;
  public $updated_at;
  public $user;

  public function add(){
    $obDb = new Database('ativ3');
    $newId = exec('uuidgen -r');
    $obDb->insert([
        'id'         => $newId,
        'id_vin'     => $this->id_vin,
        'tp'         => $this->tp,
        'nome'       => $this->nome,
        'func'       => $this->func,
        'num_ato'    => $this->num_ato,
        'chs'        => $this->chs,
        'created_at' => $this->created_at,
      //'updated_at' => $this->updated_at,
        'user'       => $this->user
    ]);
    return $newId;
  }


  public function atualizar(){
    return ( new Database('ativ3'))->update('id = "'.$this->id.'" ', [
       // 'id_vin'     => $this->id_vin,
        'tp'         => $this->tp,
        'nome'       => $this->nome,
        'func'       => $this->func,
        'num_ato'    => $this->num_ato,
        'chs'        => $this->chs,
        'updated_at' => $this->updated_at,
        'user'       => $this->user

    ]);
  }

  public static function get($where = null, $order = null, $limit = null){
    return (new Database('ativ3'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  } 

  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('ativ3'))->select($where)
                                     ->fetchObject(self::class);
  }


  public static function getQntd($where = null){
    return (new Database('ativ3'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }


}