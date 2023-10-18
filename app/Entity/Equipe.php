<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class Equipe {
  public $id;
  public $idproj;
  public $nome;
  public $instituicao;
  public $formacao;
  public $funcao;
  public $tel;
  public $email;
  public $created_at;
  public $updated_at;
  public $user;

    
  
  function incluir($id, $idproj, $nome, $instituicao, $formacao, $funcao, $tel, $email = null, $user = null){
    $this->id = $id;
    $this->idproj = $idproj;
    $this->nome = $nome;
    $this->instituicao = $instituicao;
    $this->formacao = $formacao;
    $this->funcao = $funcao;
    $this->tel = $tel;
    $this->email = $email;
    $this->user = $user;
    $this->cadastrar();
  }

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    $obDatabase = new Database('equipe');
    $obDatabase->insert([
                         'id'           => $this->id,
                         'idproj'       => $this->idproj,
                         'nome'         => $this->nome,
                         'instituicao'  => $this->instituicao,
                         'formacao'     => $this->formacao,
                         'funcao'       => $this->funcao,
                         'tel'          => $this->tel,
                         'email'        => $this->email,
                         'user'         => $this->user
                       ]);

    //RETORNAR SUCESSO
    return true;
  }

 /**
   * Método responsável por excluir a professor do banco
   * @return boolean
   */
  public static function excluir($idproj){
    return (new Database('equipe'))->delete('idproj = "'.$idproj .'"');
  }

  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getMembProj($idproj){
    return (new Database('equipe'))->select('idproj = "'.$idproj .'"' )
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }


  /**
   * Método responsável por obter as professores do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getMembros($where = null, $order = null, $limit = null){
    return (new Database('equipe'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }
 
}