<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Centro{

  public $id;
  public $nome;
  public $dir_ca_id;
  public $campus_id;
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
      return (new Database('centros'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  string $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('centros'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  


  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  string $id
   * @return Colegiado
   */
  public static function getRegistro($id){
    return (new Database('centros'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por excluir a Registro do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('centros'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('centros'))->update('id = "'.$this->id.'" ',[
                                                                'nome'    => $this->nome,
                                                                'dir_ca_id' => $this->dir_ca_id,
                                                                'campus_id' => $this->campus_id,
                                                                'updated_at' => date("Y-m-d H:i:s"),
                                                                'user' => $this->user
                                                              ]);
  }


  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
    // $this->data = date('Y-m-d H:i:s');
    $obDatabase = new Database('centros');
    $this->id = $obDatabase->insert([
                                      'nome'    => $this->nome,
                                      'user' => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }


}