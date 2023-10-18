<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Arquivo{
  public $nome_orig;
  public $nome_rand;
  public $size;
  public $tipo;
  public $error;
  public $tabela;
  public $id_tab;
  public $user;

  /**
   * Método responsável por cadastrar dados de um arquivo anexo no banco
   * @return boolean
   */
  public function cadastrar(){
    $obDatabase = new Database('anexos');
    $obDatabase->insert([
                          'nome_orig' => $this->nome_orig,
                          'nome_rand' => $this->nome_rand,
                          'size'      => $this->size,
                          'tipo'      => $this->tipo,
                          'error'     => $this->error,
                          'tabela'    => $this->tabela,
                          'id_tab'    => $this->id_tab,
                          'user'      => $this->user
                        ]);

    return true;
  }

  /**
   * Método responsável por excluir dados de uma arquivo anexo no banco
   * @return boolean
   */
  public function excluir(){
    return (new Database('anexos'))->delete('nome_rand = "'.$this->nome_rand.'"');
  }

  /**
   * Método responsável por obter as lista de anexos do banco de dados
   * @param  string $where
   * @param  string $order
   * @param  string $limit
   * @return array
   */
  public static function getArquivos($where = null, $order = null, $limit = null){
    return (new Database('anexos'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

  /**
   * Método responsável por buscar uma Arquivo com base em seu nome_rand
   * @param  string $nome_rand
   * @return Arquivo
   */
  public static function getArquivo($nome_rand){
    /*return (new Database('anexos'))->select('nome_rand = "'.$nome_rand.'"')
               ->fetchObject(self::class);
               */
    $sql = "
    select 
      a.nome_rand,
      a.nome_orig,
      a.tabela,
      a.id_tab
    from 
      anexos a
    where 
      a.nome_rand = '". $nome_rand."' limit 1";
    return (new Database())->selectJ($sql)
       ->fetchObject(self::class);
  }

  /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */
  public function atualizar(){
    $where = '"'.$this->nome_rand.'"';
    return (new Database('anexos'))->update('nome_rand = '. $where,[
                                                      'nome_orig' => $this->nome_orig,
                                                      'nome_rand' => $this->nome_rand,
                                                      'size'      => $this->size,
                                                      'tipo'      => $this->tipo,
                                                      'error'     => $this->error,
                                                      'tabela'    => $this->tabela,
                                                      'id_tab'    => $this->id_tab,
                                                      'user'      => $this->user
                                                              ]);
  }

    /**
   * Método responsável por excluir dados de uma arquivo anexo no banco
   * @return boolean
   */
  public static function excluir_tmp(){
    //tabela = 'avaliar' and id_tab is null and del = 1;
    return (new Database('anexos'))->delete('and del = 1');
  }


  public static function getAnexados($tabela, $id_tab){
    $sql = "
         select 
           a.nome_rand,
           a.nome_orig,
           a.tabela,
           a.id_tab
         from 
           anexos a
         where 
           a.tabela = '". $tabela ."'
           and a.id_tab = '". $id_tab."'";
            
    return (new Database())->selectJ($sql)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

}