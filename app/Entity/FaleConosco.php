<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;
use \App\Entity\UuiuD;

class FaleConosco {

    public $id;
    public $sistema;
    public $url;
    public $tipomsg;
    public $assunto;
    public $msg;
    public $created_at;
    public $updated_at;
    public $user;

    public function cadastrar(){
        $newId = UuiuD::gera();
        $obDatabase = new Database('faleconosco');
        $obDatabase->insert([
           'id'      => $newId,
           'sistema' => $this->sistema,
           'url'     => $this->url,
           'assunto' => $this->assunto,
           'tipomsg' => $this->tipomsg,
           'msg'     => $this->msg,
           'created_at' => date("Y-m-d H:i:s"),
           'user'    => $this->user

        ]);
        return $newId;
    }


    public static function get($where = null, $order = null, $limit = null){
        return (new Database('mensagens'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getById($id){
        $where = ' id = "'.$id.'" ';
        return (new Database('mensagens'))->select($where)
                                         ->fetchObject(self::class);
      }
}