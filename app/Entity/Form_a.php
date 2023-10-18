<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Form_a{

  public $id_proj;
  public $ver_proj;
  public $id_avaliacao;
  public $id_avaliador;

  public $r3_1;
  public $r3_2;
  public $r3_3;
  public $r3_4;
  public $r3_5;
  public $r3_6;
  public $r3_7;
  public $r4_1;
  public $r4_2;
  public $r4_3;
  public $r4_4;
  public $r4_5;
  public $solicitacoes;
  public $parecer;

  public $cidade;  
  public $whosigns; // Nome fulando + cargo 
  public $dateAssing;
  public $resultado;

  public $created_at;
  public $updated_at;
  public $user;

  /**
  * Método responsável por buscar um Registro com base em seu ID
  * @param  string $id
  * @return Form_a
  */
  public static function getRegistro($id_proj, $ver_proj){
    return (new Database('form_a'))->select(  '(id_proj, ver_proj)  = ("'.$id_proj.'", "'.$ver_proj.'")'  )
                                  ->fetchObject(self::class);
  }



  public function cadastrar(){
    //DEFINIR A DATA
    // $this->data = date('Y-m-d H:i:s');
    $obDatabase = new Database('form_a');
    $obDatabase->insert([
                          'id_proj'      => $this->id_proj,
                          'ver_proj'     => $this->ver_proj,
                          'id_avaliacao'     => $this->id_avaliacao,
                          'id_avaliador'     => $this->id_avaliador,
                          'r3_1'     => $this->r3_1,
                          'r3_2'     => $this->r3_2,
                          'r3_3'     => $this->r3_3,
                          'r3_4'     => $this->r3_4,
                          'r3_5'     => $this->r3_5,
                          'r3_6'     => $this->r3_6,
                          'r3_7'     => $this->r3_7,
                          'r4_1'     => $this->r4_1,
                          'r4_2'     => $this->r4_2,
                          'r4_3'     => $this->r4_3,
                          'r4_4'     => $this->r4_4,
                          'r4_5'     => $this->r4_5,
                          'solicitacoes' => $this->solicitacoes,
                          'parecer'      => $this->parecer,
                          'cidade'       => $this->cidade,
                          'whosigns'     => $this->whosigns,
                          'dateAssing'   => date("Y-m-d H:i:s"),
                          'resultado'    => $this->resultado,
                          'created_at'   => date("Y-m-d H:i:s"),
//                        'updated_at'   => $this->updated_at,
                          'user'         => $this->user
                       ]);

    //RETORNAR SUCESSO
    return true;
  }

  
    /**
   * Método responsável por atualizar a Registro no banco
   * @return boolean
   */

   public function atualizar(){
    return (new Database('form_a'))->update('(id_proj, ver_proj) = ("'.$this->id_proj.'", '.$this->ver_proj.' )',
                                            [
                                               'id_avaliacao'     => $this->id_avaliacao,
                                               'id_avaliador'     => $this->id_avaliador,
                                               'r3_1'     => $this->r3_1,
                                               'r3_2'     => $this->r3_2,
                                               'r3_3'     => $this->r3_3,
                                               'r3_4'     => $this->r3_4,
                                               'r3_5'     => $this->r3_5,
                                               'r3_6'     => $this->r3_6,
                                               'r3_7'     => $this->r3_7,
                                               'r4_1'     => $this->r4_1,
                                               'r4_2'     => $this->r4_2,
                                               'r4_3'     => $this->r4_3,
                                               'r4_4'     => $this->r4_4,
                                               'r4_5'     => $this->r4_5,
                                               'solicitacoes'     => $this->solicitacoes,
                                               'parecer'      => $this->parecer,
                                               'cidade'       => $this->cidade,
                                               'whosigns'     => $this->whosigns,
                                               'dateAssing'   => date("Y-m-d H:i:s"),
                                               'resultado'    => $this->resultado,
                                               'updated_at' => date("Y-m-d H:i:s"),
                                               'user'       => $this->user
                                            ]);
  }

}
