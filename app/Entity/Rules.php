<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class Rules {

  public $id;
  public $nome;
  public $por;
  public $created_at;
  public $updated_at;
  public $user;

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR REGISTRO NO BANCO
    $newId = exec('uuidgen -r');
    $obDatabase = new Database('regras');
    $obDatabase->insert([
                         'id'           => $newId,
                         'nome'         => $this->nome,
                         'por'          => $this->por,
                         //'updated_at' => date("Y-m-d H:i:s"),
                         'user' => $this->user
                       ]);

    //RETORNAR SUCESSO
    return true;
  }



  /**
   * Método responsável por atualizar REGISTRO no banco
   * @return boolean
   */
  public function atualizar(){ 
    return (new Database('regras'))->update('id = "'.$this->id.'" ',[
                                                                'nome'         => $this->nome,
                                                                'por'          => $this->por,
                                                                'updated_at'   => date("Y-m-d H:i:s"),
                                                                'user'         => $this->user
                                                              ]);
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('regras'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getRegras($where = null, $order = null, $limit = null){
    return (new Database('regras'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getRegraVigente($where = null, $order = null, $limit = null){
    return (new Database('regra_vigente'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegras($where = null){
    return (new Database('regras'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}