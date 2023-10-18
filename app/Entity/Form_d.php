<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Form_D{

  public $id_proj;
  public $ver_proj;
  public $id_avaliacao;
  public $id_avaliador;

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
    return (new Database('form_d'))->select(  '(id_proj, ver_proj)  = ("'.$id_proj.'", '.$ver_proj.')'  )
                                  ->fetchObject(self::class);
  }

  
  public function cadastrar(){
    //DEFINIR A DATA
    // $this->data = date('Y-m-d H:i:s');
    $obDatabase = new Database('form_d');
    $obDatabase->insert([
                          'id_proj'      => $this->id_proj,
                          'ver_proj'     => $this->ver_proj,
                          'id_avaliacao' => $this->id_avaliacao,
                          'id_avaliador' => $this->id_avaliador,
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
    return (new Database('form_d'))->update('(id_proj, ver_proj) = ("'.$this->id_proj.'", '.$this->ver_proj.' )',
                                            [
                                               'id_avaliacao'     => $this->id_avaliacao,
                                               'id_avaliador'     => $this->id_avaliador,
                       
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
