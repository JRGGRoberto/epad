<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;


use \App\Entity\PADAtiv22;
use \App\Entity\PADAtiv23;
use \App\Entity\PADAtiv24;
use \App\Entity\PADAtiv3;
use \App\Entity\PADAtiv4;


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
  public $obscoord;
  public $created_at;
  public $updated_at;
  public $aprov_co_id;
  public $aprov_co_data;
  public $aprov_ce_id;
  public $aprov_ce_data;
  public $user;

  public function cadastrar(){
    $newId = UuiuD::gera(); //exec('uuidgen -r');
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


  public function assing_co(){
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
      'aprov_co_id'   =>  $this->aprov_co_id,
      'aprov_co_data' =>  date("Y-m-d H:i:s")
    ]);
  }

  public function assing_co_remove(){
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
      'aprov_co_id'   =>  null,
      'aprov_co_data' =>  null
    ]);
  }



  public function assing_ce(){
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
      'aprov_ce_id'   =>  $this->aprov_ce_id,
      'aprov_ce_data' =>  date("Y-m-d H:i:s")
    ]);
  }

  public function assing_ce_remov(){
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
      'aprov_ce_id'   =>  null,
      'aprov_ce_data' =>  null
    ]);
  }


  public function edtObs(){
    return (new Database('vinculo'))->update('id = "'.$this->id.'" ',[
      'obscoord'   =>  $this->obscoord
    ]);
  }


  public function excluir(){
    // C:\Users\Roberto\Dev\dockersist\www\php7\epad\padstopdf\indexHtml.php


    $PADAtiv22 = new PADAtiv22();
    $PADAtiv22->get('vinculo = "'.$this->id. '"');

    $PADAtiv22[0];
    
    foreach($PADAtiv22 as $p22){
      
      
    }
    
/*
    $PADAtiv23 = new PADAtiv23::getById($this->id);
    $PADAtiv24 = new PADAtiv24::getById($this->id);
    $PADAtiv3 = new PADAtiv3::getById($this->id);
    $PADAtiv4 = new PADAtiv4::getById($this->id);
    
    return (new Database('vinculo'))->delete('id = "'.$this->id .'"');
*/
  }

  public static function getByAnoProf($idprof, $ano){
    return (new Database('vinculov'))->select('(id_prof, ano) = ("'.$idprof.'", '. $ano .')')
                                  ->fetchObject(self::class);
  }

  public static function getwh($where){
    return (new Database('vinculov'))->select($where)
                                     ->fetchObject(self::class);
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
