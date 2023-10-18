<?php

namespace App\Entity;

use \App\Db\Database;
use App\Session\Login;

class Usuario{

  public $id;
  public $nome;
  public $lattes;
  public $titulacao;
  public $email;
  public $telefone;
  public $id_colegiado;
  public $cat_func;
  public $ativo;
  public $senha;
  public $adm;
  public $created_at;
  public $uddated_at;
  public $user;
  public $ca_id;
  public $campus;
  public $chef_div_id;
  public $chef;
  public $ce_id;
  public $centros;
  public $dir_ca_id;
  public $dir_ca;
  public $co_id;
  public $colegiado;
  public $coord_id;
  public $coord;
  public $nivel;
  public $niveln;
  public $tpnivel;

  /**
   * Método responsável por retornar uma instancia de usuário com base em seu e-mail
   * @param string $email
   * @return Usuário
   */
  public static function getUsuarioPorEmail($email){
   return (new Database('userprof'))->select('email ="'.$email.'"')->fetchObject(self::class);
  }
  

  public function updateSenha(){ 
      
      return (new Database('professores'))->update('id = '.$this->id_prof,[
                                                                  'senha' => $this->nsenha , 
                                                                  'updated_at' => date("Y-m-d H:i:s"),
                                                                ]);
  }

}
