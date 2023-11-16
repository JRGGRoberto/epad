<?php

namespace App\Entity;

use \App\Db\Database;
use App\Session\Login;

class Usuario{

  public $id;
  public $nome;
  public $email;
  public $lota_id;
  public $lota_nome;
  public $senha;
  public $config;
  public $tipo;

  /**
   * Método responsável por retornar uma instancia de usuário com base em seu e-mail
   * @param string $email
   * @return Usuário
   */
  public static function getUsuarioPorEmail($email){
   return (new Database('usuarios'))->select('email ="'.$email.'"')->fetchObject(self::class);
  }
  

  public function updateSenha(){ 

      if ($this->tipo == 'agente') {
        return (new Database('agentes'))->update('id = '.$this->id,[
                                                                  'senha' => $this->senha , 
                                                                  'updated_at' => date("Y-m-d H:i:s"),
                                                                ]);
      }
  }

}
