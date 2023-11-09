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

  public static function getVinculo($id){
    $where = ' id = "'.$id.'" ';
    return (new Database('vinculov'))->select($where)
                                     ->fetchObject(self::class);
  }

}
