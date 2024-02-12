<?php

require '../vendor/autoload.php';

use \App\Entity\Vinculo;
use \App\Entity\Outros;
use \App\Entity\PADAtiv22;
use \App\Entity\PADAtiv3;
use \App\Entity\PADAtiv4;

$ano = '2024';
$vinc = Vinculo::getByAnoProf($idprof, $ano);

if(!$vinc instanceof Vinculo){
   echo 'O vinculo desta referência não foi realizada para o ano de '. $ano . '.';
   exit;
 }

  $where = ' vinculo = "'. $vinc->id . '" ';
  $sql = 'select * from pad21d where '. $where . ' order by disciplina, atividade';

$pad21 = Outros::qry($sql);
$pad22 = PADAtiv22::get($where);
$pad3  = PADAtiv3::get($where);
$pad4  = PADAtiv4::get($where);

include __DIR__.'/includes/pad1.php';
include __DIR__.'/includes/pad21.php';
include __DIR__.'/includes/pad22.php';
include __DIR__.'/includes/pad3.php';
include __DIR__.'/includes/pad4.php';
include __DIR__.'/includes/pad5.php';
include __DIR__.'/includes/pad6.php';
include __DIR__.'/includes/pad7.php';

