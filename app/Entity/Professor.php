<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class Professor {
  public $id;
  public $nome;
  public $cpf;
  public $telefone;
  public $lattes;
  public $titulacao;
  public $email;
  public $id_colegiado;
  public $cat_func;
  public $ativo;
  public $senha;
  public $adm;
  public $created_at;
  public $updated_at;
  public $niveln;
//  public $colegiado;
  public $user;

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $newId = exec('uuidgen -r');
    $obDatabase = new Database('professores');
    $obDatabase->insert([
                         'id'           => $newId,
                         'nome'         => $this->nome,
                         'cpf'          => $this->cpf,
                         'telefone'     => $this->telefone,
                         'lattes'       => $this->lattes,
                         'titulacao'    => $this->titulacao,
                         'email'        => $this->email,
                         'id_colegiado' => $this->id_colegiado,
                         'cat_func'     => $this->cat_func,
                         'ativo'        => $this->ativo,
                         'senha'        => $this->senha,
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
    return (new Database('professores'))->update('id = "'.$this->id.'" ',[
                                                                'nome'         => $this->nome,
                                                                'cpf'          => $this->cpf,
                                                                'telefone'     => $this->telefone,
                                                                'lattes'       => $this->lattes,
                                                                'titulacao'    => $this->titulacao,
                                                                'email'        => $this->email,
                                                                'id_colegiado' => $this->id_colegiado,
                                                                'cat_func'     => $this->cat_func,
                                                                'ativo'        => $this->ativo,
                                                                'senha'        => $this->senha,
                                                                'updated_at'   => date("Y-m-d H:i:s"),
                                                                'user'         => $this->user
                                                              ]);
  }

  /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('professores'))->delete('id = '.$this->id);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getProfessores($where = null, $order = null, $limit = null){
    return (new Database('userprof'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getProfessor($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('userprof'))->select($where)
                                     ->fetchObject(self::class);
  }


  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getDadosProf($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('professores'))->select($where)
                                     ->fetchObject(self::class);
  }


  /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntdProfessores($where = null){
    return (new Database('userprof'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }
 
}