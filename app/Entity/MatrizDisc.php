<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class MatrizDisc {
  public $id;
  public $id_curso;
  public $ano;
  public $ch;
  public $habilitacao;
  public $oferta;
  public $turno;
  public $vagas;
  public $created_at;
  public $updated_at;
  public $user;
  
/**
   * Método responsável por cadastrar um novo registro
   * @return $newId
   */

   public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $newId = exec('uuidgen -r');
    $obDatabase = new Database('matriz_disc');
    $obDatabase->insert([
                         'id'           => $newId,
                         'id_curso'     => $this->id_curso,
                         'ch'           => $this->ch,
                         'ano'          => $this->ano,
                         'habilitacao'  => $this->habilitacao,
                         'oferta'       => $this->oferta,
                         'turno'        => $this->turno,
                         'vagas'        => $this->vagas,
                         //'updated_at' => date("Y-m-d H:i:s"),
                         'user' => $this->user
                       ]);

    //RETORNAR SUCESSO
    return $newId;
  }

  /**
   * Método responsável por atualizar REGISTRO no banco
   * @return boolean
   */
  public function atualizar(){ 
    return (new Database('matriz_disc'))->update('id = "'.$this->id.'" ',[
                                                                'id_curso'     => $this->id_curso,
                                                                'ano'          => $this->ano,
                                                                'ch'           => $this->ch,
                                                                'habilitacao'  => $this->habilitacao,
                                                                'oferta'       => $this->oferta,
                                                                'turno'        => $this->turno,
                                                                'vagas'        => $this->vagas,
                                                                'updated_at'   => date("Y-m-d H:i:s"),
                                                                'user'         => $this->user
                                                              ]);
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('matriz_disc'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as dados do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function get($where = null, $order = null, $limit = null){
    return (new Database('matriz_cur'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter registro do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return object
   */
  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('matriz_disc'))->select($where)
                                     ->fetchObject(self::class);
  }



  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('matriz_disc'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}