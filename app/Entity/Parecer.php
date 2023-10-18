<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Parecer{

  public $id;
  public $id_proj;
  public $solicitant_id;
  public $parecer;
  public $id_prof;
  public $dt_av;
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
    return (new Database('parecer'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('pareceres'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Pareceres
   */
  public static function getRegistro($id_proj){
    return (new Database('parecer'))->select('id_proj = '.$id_proj)
                                  ->fetchObject(self::class);
  }


  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Pareceres
   */
  public static function getRegistroByID($id){
    return (new Database('parecer'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por excluir a Registro do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('pareceres'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('pareceres'))->update('id = '.$this->id,[
                                                                'solicitant_id'    => $this->solicitant_id,
                                                                'parecer'    => $this->parecer,
                                                                'id_prof'    => $this->id_prof,
                                                                'updated_at' => date("Y-m-d H:i:s"),
                                                                'user' => $this->user
                                                              ]);
  }


  /**
   * Método responsável por atualizar a Registro no banco 2    
   * @return boolean
   */
  public function gerar(){
    return (new Database('pareceres'))->update('id = '.$this->id,[
                                                                'parecer'    => $this->parecer,
                                                                'resu_ata'    => $this->resu_ata,
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
    $obDatabase = new Database('pareceres');
    $this->id = $obDatabase->insert([
                                      'solicitant_id'    => $this->solicitant_id,
                                      'id_proj'    => $this->id_proj,
                                      'id_prof'    => $this->id_prof,
                                      'user' => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return $this->id;
  }


}