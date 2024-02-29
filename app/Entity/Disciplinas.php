<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class Disciplinas {
  public $id;
  public $nome;
  public $ch;
  public $serie;
  public $id_matriz;
  public $vinculo;
  public $vinclogchuser;
  public $vinclogchdate;
  public $created_at;
  public $updated_at;
  public $user;
  
  /**
   * Método responsável por cadastrar um novo registro
   * @return varchar
   */

   public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $newId = UuiuD::gera(); //exec('uuidgen -r');
    $obDatabase = new Database('disciplinas');
    $obDatabase->insert([
                         'id'        => $newId,
                         'nome'      => $this->nome,
                         'ch'        => $this->ch,
                         'serie'     => $this->serie,
                         'id_matriz'  => $this->id_matriz,
                         'created_at' => date("Y-m-d H:i:s"),
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
  public function atribuir(){ 
    return (new Database('disciplinas'))->update('id = "'.$this->id.'" ',[
                                                                'vinculo'       => $this->vinculo,
                                                                'vinclogchuser' => $this->vinclogchuser,
                                                                'vinclogchdate' => date("Y-m-d H:i:s")
                                                              ]);
  }


  /**
   * Método responsável por atualizar REGISTRO no banco
   * @return boolean
   */
  public function atualizar(){ 
    return (new Database('disciplinas'))->update('id = "'.$this->id.'" ',[
                                                                'nome'      => $this->nome,
                                                                'ch'        => $this->ch,
                                                                'serie'     => $this->serie,
                                                                'id_matriz'  => $this->id_matriz,
                                                                'updated_at'   => date("Y-m-d H:i:s"),
                                                                'user'         => $this->user
                                                              ]);
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('disciplinas'))->delete('id = "'.$this->id .'"');

  }

  /**
   * Método responsável por obter as dados do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function get($where = null, $order = null, $limit = null){
    return (new Database('disciplinasv'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter registro do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return Disciplinas
   */
  public static function getById($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('disciplinas'))->select($where)
                                     ->fetchObject(self::class);
  }



  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('disciplinas'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

   /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdPreen($where = null){
    return (new Database('disciplinasv'))->select($where, null, null, 'COUNT(professor) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}