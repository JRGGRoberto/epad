<?php

require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Outros;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$galeraDoSuporte = array(
  'b8fa555f-cedb-47cf-91cc-7581736aac88', // Roberto
  '8154fff1-becd-11ee-801b-0266ad9885af',   // Sérgio
  '81512d7d-becd-11ee-801b-0266ad9885af' );   // Dorigão

if(!in_array($user['id'], $galeraDoSuporte)){ 
  header('location: ../home/');
  exit;
}


$qry1 = "select * from anos a order by a.ano desc  ";
$coodYY = Outros::qry($qry1);
$btnANOSy = '';
$qnty = 0;
foreach($coodYY as $Ys){
  $act = '';
  $ck = '';

  if(($user['year_sel'] == '' or $user['year_sel'] == null) and $qnty > 0 ){
    $act = 'active';
    $ck = 'checked';
  }

  $btnANOSy .=  '<label class="btn btn-primary '.$act.' btn-sm">';
  $btnANOSy .= '<input type="radio" name="radioAC" '.$ck.' value="'. $Ys->ano .'"  onclick="chValueS(`'.$Ys->ano .'`);"  >'. $Ys->ano.'
  </label>';

  if($act == 'active') {
    $anoCurso = $Ys->ano;
  }

  $qnty++;
}


if(($user['year_sel'] == '' or $user['year_sel'] == null) and $qnty > 0 ){
  $scriptSel1opcao = 
    "<script>
      chValueS(`".$anoCurso ."`);
    </script>";
}





use \App\Entity\Vinculo;



$where = ' ano  =  ' . $user['year_sel'];
$order = ' campus, codcentro, colegiado, nome ';
$vinc = Vinculo::gets($where, $order);
$tab = '';
foreach($vinc as $v){
  $tab .= '<tr>';
    $tab .= '<td>'. $v->campus .'</td> <td>'. $v->codcentro .'</td><td>'. $v->colegiado .'</td>';
    $tab .= '<td>'. $v->nome .
                '<a href="../padstoprn/index.php?id='.  $v->id .'" target="_blank">🅿️</a>
                 
            </td>' ;
    $tab .= '<td style="text-align: right;">'. $v->rt .'</td>';
  $tab .= '</tr>';
}


if($user['tipo'] == 'agente') {
  header('location: ../matrizes/');
  exit;
} elseif($user['tipo'] == 'prof') {

  include '../includes/header.php';
  
  include __DIR__.'/includes/content.php';
  
  include '../includes/footer.php';
  echo $scriptSel1opcao; 
   
} else {
   header('location: ../login/logout.php');
   exit; 
}


