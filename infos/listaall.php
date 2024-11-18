<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Outros;

if(!($user['adm'] == 1)){
  header('location: ../');
  exit;
}



$sql = "select UPPER(codcam) as ca, colegiado, co_id  from ca_ce_co ccc
order by 1, 2";
$lista = Outros::qry($sql);


$qrYeas = 'select * from anos';
$anos = Outros::qry($qrYeas);

include '../includes/header.php';

$tbl_dir = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Campus</th>
        <th class="align-top">Colegiado</th>
        <th class="align-top" colspan="'. count($anos).'"><center>Relatórios</center></th>
    </tr>
</thead>
<tbody>';

foreach( $lista as $coleg){
  $tbl_dir .= '
    <tr>
      <td>'. $coleg->ca .'</td>
      <td>'. $coleg->colegiado .'</td>';
      foreach($anos as $y){
           $tbl_dir .= '
           <td><a href="./datac.php?id='.$coleg->co_id . $y->ano. '" class"btn-primary" > 📄'. $y->ano. '</a></td>' ;
      }
  $tbl_dir .= '
      </tr>' ;
}

$tbl_dir .= '</tbody></table>';


include './includes/lista_table.php';

include '../includes/footer.php';