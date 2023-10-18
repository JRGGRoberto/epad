<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Campi{

  public $id;
  public $nome;
  public $codigo;
  public $chef_div_id;
  public $created_at;
  public $updated_at;
  public $user;

  
  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
   // $this->data = date('Y-m-d H:i:s');

    //INSERIR A VAGA NO BANCO
    $obDatabase = new Database('campi');
    $this->id = $obDatabase->insert([
                                      'nome' => $this->nome,
                                      'codigo' => $this->codigo,
                                      'user' => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('campi'))->update(
                                           'id = "'.$this->id.'" ',[
                                                                'nome'    => $this->nome,
                                                                'codigo' => $this->codigo,
                                                                'chef_div_id' => $this->chef_div_id,
                                                                'updated_at' => date("Y-m-d H:i:s"),
                                                                'user' => $this->user
                                                              ]);
  }

  /**
   * Método responsável por obter as registros do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getRegistros($where = null, $order = null, $limit = null){
    return (new Database('campi'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('campi'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Campi
   */
  public static function getRegistro($id){
        return (new Database('campi'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por excluir a Registro do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('campi'))->delete('id = "'.$this->id.'"');
  }

  ////////////////////////////

}