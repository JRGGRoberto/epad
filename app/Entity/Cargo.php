<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class Cargo {

  public $id;
  public $id_vinculo;
  public $id_colegiado;
  public $ano;
  public $tipo;
  public $created_at;
  public $user;

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $newId = UuiuD::gera(); //exec('uuidgen -r');
    $obDatabase = new Database('cargos');
    $obDatabase->insert([
                            'id'           => $newId,
                            'id_vinculo'   => $this->id_vinculo,
                            'id_colegiado' => $this->id_colegiado,
                            'ano'          => $this->ano,
                            'tipo'         => $this->tipo,
                            'created_at'   => $this->created_at,
                            'user'         => $this->user
                       ]);

    //RETORNAR SUCESSO
    return true;
  }


  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('cargos'))->delete('id = "'.$this->id .'"');
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $whereagente
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function gets($where = null, $order = null, $limit = null){
    return (new Database('cargosv'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function get($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('cargosv'))->select($where)
                                     ->fetchObject(self::class);
  }

    /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getw($where){
    return (new Database('cargosv'))->select($where)
                                     ->fetchObject(self::class);
  }


  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('cargos'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}