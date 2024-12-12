<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class PADAtiv24 {
  public $id;
  public $vinculo;
  public $ano;
  public $modalidade;
  public $ch;
  public $tipo;
  public $portaria;
  public $dt_inicio;
  public $dt_fim;
  public $created_at;
  public $updated_at;
  public $user;

  public function cadastrar(){
    $obDb = new Database('pad24');
    $newId = UuiuD::gera(); //exec('uuidgen -r');

    $obDb->insert([
        'id'           => $newId,
        'vinculo'     => $this->vinculo,
        'ano'         => $this->ano,
        'modalidade'  => $this->modalidade,
        'ch'          => $this->ch,
        'tipo'        => $this->tipo,
        'portaria'    => $this->portaria,
        'dt_inicio'   => $this->dt_inicio,
        'dt_fim'      => $this->dt_fim,
        'created_at'     => date("Y-m-d H:i:s"),
        'updated_at'  => $this->updated_at,
        'user'        => $this->user
    ]);
    return $newId;
  }


  public function atualizar(){
    return ( new Database('pad24'))->update('id = "'.$this->id.'" ', [
        'vinculo'     => $this->vinculo,
        'ano'         => $this->ano,
        'modalidade'  => $this->modalidade,
        'ch'          => $this->ch,
        'tipo'        => $this->tipo,
        'portaria'    => $this->portaria,
        'dt_inicio'   => $this->dt_inicio,
        'dt_fim'      => $this->dt_fim,
        'updated_at'  => date("Y-m-d H:i:s"),
        'user'        => $this->user
    ]);
  }

  public static function get($where = null, $order = null, $limit = null){
    return (new Database('pad24'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  } 

  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('pad24'))->select($where)
                                     ->fetchObject(self::class);
  }


  public static function getQntd($where = null){
    return (new Database('pad24'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('pad24'))->delete('id = "'.$this->id .'"');
  }

}