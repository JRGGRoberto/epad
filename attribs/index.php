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
  p.id, p.nome, if(md.coordestag= p.id, "selected", "")  as sel,
  md.id matriz
from 
  professores p inner join vinculo v on p.id = v.id_prof
  left join matriz_disc md on md.id_curso  = p.id_colegiado 
where 
  v.ano  = md.ano 
  and v.ano  = "'. $ano .'" 
  and p.id_colegiado = "'. $co. '" ' ;

$coordEstagio = Outros::qry($sql);
$selOptionEstagio = '';
$id_matriz = '';
foreach($coordEstagio as $e){ 
   $selOptionEstagio .= '<option value="'.$e->id.'"  '.$e->sel.' >'.$e->nome.'</option>';
   $id_matriz = $e->matriz;
}

include '../includes/header.php';
echo '<script>const idmat = "'.$id_matriz .'"; </script>';
include __DIR__.'/includes/content.php';




include '../includes/footer.php';
