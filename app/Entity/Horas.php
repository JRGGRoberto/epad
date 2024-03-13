<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;


class Horas {
  public $horaexp;
  public $horamatz;
  public $created_at;
  public $updated_at;
  public $user;

/**
   * Método responsável por cadastrar uma nova pessoa no banco
   * @return boolean
   */
  public function cadastrar(){
    //INSERIR A REGISTRO NO BANCO
    $obDatabase = new Database('horas');
    $obDatabase->insert([
                         'horaexp'      => $this->horaexp,
                         'horamatz'     => $this->horamatz,
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
    return (new Database('horas'))->update('(horaexp, horamatz) = ( "'.$this->horaexp.'","'.$this->horamatz.'"  )',[
                                                          'horaexp'      => $this->horaexp,
                                                          'horamatz'     => $this->horamatz,
                                                          'updated_at'   => date("Y-m-d H:i:s"),
                                                          'user'         => $this->user
                                                        ]);
  }

  /**
   * Método responsável por excluir a horas do banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('horas'))->delete('(horaexp, horamatz) = ( "'.$this->horaexp.'","'.$this->horamatz.'"  )');
  }

  /**
   * Método responsável por obter as horas do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function gets($where = null, $order = null, $limit = null){
    return (new Database('horas'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por obter as horas do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function get($horaexp, $horamatz){
    $where = '(horaexp, horamatz) = ( "'. $horaexp .'","'.$horamatz.'"  )';
    return (new Database('userprof'))->select($where)
                                     ->fetchObject(self::class);
  }
}