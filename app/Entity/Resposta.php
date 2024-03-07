<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class Resposta {
  public $id;
  public $id_falec;
  public $resposta;
  public $status;
  public $created_at;
  public $updated_at;
  public $user;


  public function add(){
    $obDb = new Database('respostas');
    $newId = UuiuD::gera(); //exec('uuidgen -r');
    $obDb->insert([
        'id'          => $newId,
        'id_falec'     => $this->id_falec,
        'resposta'    => $this->resposta,
        'status'      => $this->status,
        'created_at'  => date("Y-m-d H:i:s"),
      //'updated_at'  => $this->updated_at,
        'user'        => $this->user
    ]);
    return $newId;
  }


  public function atualizar(){
    return ( new Database('respostas'))->update('id = "'.$this->id.'" ', [
       
       'id_falec'     => $this->id_falec,
       'resposta'    => $this->resposta,
       'status'      => $this->status,
        'updated_at'  => date("Y-m-d H:i:s"),
        'user'        => $this->user

    ]);
  }

  public static function get($where = null, $order = null, $limit = null){
    return (new Database('respostas'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  } 

  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('respostas'))->select($where)
                                     ->fetchObject(self::class);
  }


  public static function getQntd($where = null){
    return (new Database('respostas'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('respostas'))->delete('id = "'.$this->id .'"');
  }

}