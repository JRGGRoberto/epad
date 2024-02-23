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
           'user'    => $this->user

        ]);
        return $newId;
    }
}