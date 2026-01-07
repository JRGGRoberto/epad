<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Vinculo;
use \App\Entity\Outros;
use \App\Entity\PADAtiv22;
use \App\Entity\PADAtiv23;
use \App\Entity\PADAtiv24;
use \App\Entity\PADAtiv3;
use \App\Entity\PADAtiv4;

$id = $_GET["id"];

$vinc = Vinculo::get($id);
if(!$vinc instanceof Vinculo){
   echo 'O vinculo desta referência não foi realizada para o ano de '. $ano . '.';
   exit;
 }

  $where = ' vinculo = "'. $vinc->id . '" ';
  $sql = 'select * from pad21d where '. $where . ' order by atividade, disciplina ';

$pad21 = Outros::qry($sql);
$pad22 = PADAtiv22::get($where);
$pad23 = PADAtiv23::get($where);
$pad24 = PADAtiv24::get($where);
$pad3  = PADAtiv3::get($where);
$pad4  = PADAtiv4::get($where);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/pad1.php';
include __DIR__.'/includes/pad21.php';
include __DIR__.'/includes/pad22.php';
include __DIR__.'/includes/pad23.php';
include __DIR__.'/includes/pad24.php';
include __DIR__.'/includes/pad3.php';
include __DIR__.'/includes/pad4.php';
include __DIR__.'/includes/pad5.php';
include __DIR__.'/includes/pad6.php';
echo '<hr><hr>';
include __DIR__.'/includes/pad7.php';
include __DIR__.'/includes/footer.php';
