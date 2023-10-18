<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class RegrasDef{

  public $id;
  public $id_reg;
  public $nome;
  public $form;
  public $tp_avaliador;
  public $sequencia;
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
    return (new Database('regras_defin'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdRegistros($where = null){
    return (new Database('regras_defin'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
  
  /**
   * Método responsável por buscar um Registro com base em seu ID
   * @param  integer $id
   * @return Colegiado
   */
  public static function getRegistro($id){
    return (new Database('regras_defin'))->select('id = "'.$id.'"')
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por excluir a Registro do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('regras_defin'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */

  public function atualizar(){
    return (new Database('regras_defin'))->update('id = "'.$this->id.'" ',[
                                                                 'id_reg' => $this->id_reg,
                                                                 'nome' => $this->nome,
                                                                 'form' => $this->form,
                                                                 'tp_avaliador' => $this->tp_avaliador,
                                                                 'sequencia' => $this->sequencia,
                                                                 'updated_at' => date("Y-m-d H:i:s"),
                                                                 'user'       => $this->user
                                                              ]);
  }



  /**
   * Método responsável por cadastrar um novo Registro no banco
   * @return boolean
   */
  public function cadastrar(){
    $newId = exec('uuidgen -r');
    $obDatabase = new Database('regras_defin');
    $this->id = $obDatabase->insert([
                                      'id'           => $newId,
                                      'id_reg' => $this->id_reg,
                                      'nome' => $this->nome,
                                      'form' => $this->form,
                                      'tp_avaliador' => $this->tp_avaliador,
                                      'sequencia' => $this->sequencia,
                                      'user'       => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }


}