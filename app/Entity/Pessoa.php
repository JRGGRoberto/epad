<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Pessoa{

  public $id;
  public $nome;
  public $cpf;
  public $tel;
  public $updated_at;
  public $user;
  

  /**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //DEFINIR A DATA
    

    //INSERIR A PESSOA NO BANCO
    $obDatabase = new Database('pessoas');
    $this->id = $obDatabase->insert([
                                      'cpf'   => $this->cpf,
                                      'nome'   => $this->nome,
    //                                  'dt_nasc' => $this->dt_nasc,
    //                                  'email' => $this->email,
                                      'tel'   => $this->tel,
                                      // 'updated_at' =>  date("Y-m-d H:i:s"),
                                      'user' => $this->user
                                    ]);

    //RETORNAR SUCESSO
    return true;
  }

  /**
   * Método responsável por atualizar a pessoa no banco
   * @return boolean
   */
  public function atualizar(){
    return (new Database('pessoas'))->update('id = '.$this->id,[
                                                                'cpf'   => $this->cpf,
                                                                'nome'   => $this->nome,
  //                                                              'dt_nasc' => $this->dt_nasc,
  //                                                             'email' => $this->email,
                                                                'tel'   => $this->tel,
                                                                'updated_at' =>  date("Y-m-d H:i:s"),
                                                                'user' => $this->user
                                                              ]);
  }

  /**
   * Método responsável por excluir a pessoa do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('pessoas'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as pessoas do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getPessoas($where = null, $order = null, $limit = null){
    return (new Database('pessoas'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

/**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdPessoas($where = null){
    return (new Database('pessoas'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }


  /**
   * Método responsável por buscar uma Pessoa com base em seu ID
   * @param  integer $id
   * @return Pessoa
   */
  public static function getPessoa($id){
    return (new Database('pessoas'))->select('id = '.$id)
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por buscar uma Pessoa com base em seu email
   * @param  string $email
   * @return Pessoa
   */
  public static function getPessoaPorEmail($email){
    return (new Database('pessoas'))->select('email = '.$email)
                                  ->fetchObject(self::class);
  }

  /**
   * Método responsável por buscar uma Pessoa com base em seu CPF
   * @param  string $cpf
   * @return Pessoa
   */
  public static function getPessoaPorCPF($cpf){
    return (new Database('pessoas'))->select('cpf = '.$cpf)
                                  ->fetchObject(self::class);
  }

}