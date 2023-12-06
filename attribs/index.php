<?php

require '../vendor/autoload.php';

use \App\Entity\MatrizDisc;
use \App\Entity\Outros;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();


if($user['tipo'] != 'prof'){
  header('location: ../home/');
  exit;
}
$ok = false;

if($user['tipo'] === 'prof' ){
   if($user['config'] == '1'){
      $ok = true;
   }
}

if(!$ok){
   header('location: ../home/');
   exit;
}



$ano = '2024';
$co = $user['co_id'];

$sql = 'select
  p.id, p.nome, if(md.coordestag= p.id, "selected", "")  as sel
from 
  professores p inner join vinculo v on p.id = v.id_prof
  left join matriz_disc md on md.id_curso  = p.id_colegiado 
where 
  v.ano  = md.ano 
  and v.ano  = "'. $ano .'" 
  and p.id_colegiado = "'. $co. '" ' ;

$coordEstagio = Outros::qry($sql);




/*
$matriz = new MatrizDisc();
$matriz = $matriz::getById($_GET['id']);


$inf = Outros::hierCol($matriz->id_curso);

*/



include '../includes/header.php';
//include __DIR__.'/includes/listagem.php';

echo  '<pre>';
print_r($user);
print_r($coordEstagio);
echo  '</pre>';
include '../includes/footer.php';
