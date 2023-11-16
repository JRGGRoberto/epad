<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vinculo {
  public $id;
  public $ano;
  public $rt;
  public $id_prof;
  public $area_concurso;
  public $dt_obtn_tit;
  public $tempo_cc;
  public $tempo_esu;
  public $obs;
  public $created_at;
  public $updated_at;
  public $user;

  public function cadastrar(){
    $newId = exec('uuidgen -r');
    $obDB = new Database('vinculo');
    $obDB->insert([
        'id'            =>  $newId,
        'ano'           =>  $this->ano,
        'rt'            =>  $this->rt,
        'id_prof'       =>  $this->id_prof,
        'area_concurso' =>  $this->area_concurso,
        'dt_obtn_tit'   =>  $this->dt_obtn_tit,
        'tempo_cc'      =>  $this->tempo_cc,
        'tempo_esu'     =>  $this->tempo_esu,
        'obs'           =>  $this->obs,
        'created_at'    =>  $this->created_at,
      //  'updated_at'  =>  $this->updated_at,
        'user'          =>  $this->user
    ]);
  }

  public function atualizar(){ 
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
                                                          'ano'           =>  $this->ano,
                                                          'rt'            =>  $this->rt,
                                                          'id_prof'       =>  $this->id_prof,
                                                          'area_concurso' =>  $this->area_concurso,
                                                          'dt_obtn_tit'   =>  $this->dt_obtn_tit,
                                                          'tempo_cc'      =>  $this->tempo_cc,
                                                          'tempo_esu'     =>  $this->tempo_esu,
                                                          'obs'           =>  $this->obs,
                                                          'updated_at'    => date("Y-m-d H:i:s"),
                                                          'user'          => $this->user
                                                        ]);
  }

  public function excluir(){
    return (new Database('vinculo'))->delete('id = "'.$this->id .'"');

  }

  public static function get($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('vinculov'))->select($where)
                                     ->fetchObject(self::class);
  }

  public static function gets($where = null, $order = null, $limit = null){
    return (new Database('vinculov'))->select($where,$order,$limit)
                                  ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

    /**
   * Método responsável por obter a quantidade de registros
   * @param  integer $id
   * @return integer
   */
  public static function getQntd($where = null){
    return (new Database('vinculov'))->select($where, null, null, 'COUNT(*) as qtd')
                                  ->fetchObject()
                                  ->qtd;
  }

}
