<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class Agente {

  public $id;
  public $nome;
  public $cpf;
  public $email;
  public $cat_func;
  public $ativo;
  public $lotacao;
  public $senha;
  public $config;
  public $created_at;
  public $updated_at;
  public $user;

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $newId = UuiuD::gera(); //exec('uuidgen -r');
    $obDatabase = new Database('agentes');
    $obDatabase->insert([
                            'id'         => $newId,
                            'nome'       => $this->nome,
                            'cpf'        => $this->cpf,
                            'email'      => $this->email,
                            'cat_func'   => $this->cat_func,
                            'ativo'      => $this->ativo,
                            'lotacao'    => $this->lotacao,
                            'senha'      => $this->senha,
                            'config'     => $this->config,
                            'created_at' => date("Y-m-d H:i:s"),
                          //  'updated_at' => $this->updated_at,
                            'user'       => $this->user
                       ]);

    //RETORNAR SUCESSO
    return true;
  }



  /**
   * Método responsável por atualizar REGISTRO no banco
   * @return boolean
   */
  public function atualizar(){ 
    return (new Database('agentes'))->update('id = "'.$this->id.'" ',[
                                'nome'       => $this->nome,
                                'cpf'        => $this->cpf,
                                'email'      => $this->email,
                                'cat_func'   => $this->cat_func,
                                'ativo'      => $this->ativo,
                                'lotacao'    => $this->lotacao,
                                'senha'      => $this->senha,
                                'config'     => $this->config,
                                'created_at' => $this->created_at,
                                'updated_at' => date("Y-m-d H:i:s"),
                                'user'       => $this->user
                              ]);
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('agentes'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $whereagente
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function gets($where = null, $order = null, $limit = null){
    return (new Database('agentes'))->select($where,$order,$limit)
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
    return (new Database('agentes'))->select($where)
                                     ->fetchObject(self::class);
  }


  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('agentes'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}