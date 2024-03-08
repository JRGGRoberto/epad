<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class PADAtiv23 {
  public $id;
  public $vinculo;
  public $id_co;
  public $atividade;
  public $ano;
  public $nome_atividade;
  public $id_curs;
  public $ch;
  public $created_at;
  public $updated_at;
  public $user;


  public function add(){
    $obDb = new Database('pad23');
    $newId = UuiuD::gera(); //exec('uuidgen -r');
    $obDb->insert([
        'id'             => $newId,
        'vinculo'        => $this->vinculo,
        'id_co'          => $this->id_co,
        'ano'            => $this->ano,
        'atividade'      => $this->atividade,
        'nome_atividade' => $this->nome_atividade,
        'id_curs'        => $this->id_curs,
        'ch'             => $this->ch,
        'created_at'     => date("Y-m-d H:i:s"),
      //'updated_at'     => $this->updated_at,
        'user'           => $this->user
    ]);
    return $newId;
  }


  public function atualizar(){
    return ( new Database('pad23'))->update('id = "'.$this->id.'" ', [
        'atividade'   => $this->atividade,
        'nome_atividade'  => $this->nome_atividade,
        'id_curs'      => $this->id_curs,
        'ano'            => $this->ano,
        'ch'          => $this->ch,
        'updated_at'  => date("Y-m-d H:i:s"),
        'user'        => $this->user

    ]);
  }

  public static function get($where = null, $order = null, $limit = null){
    return (new Database('pad23v'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  } 

  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('pad23v'))->select($where)
                                     ->fetchObject(self::class);
  }


  public static function getQntd($where = null){
    return (new Database('pad23'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('pad23'))->delete('id = "'.$this->id .'"');
  }

}