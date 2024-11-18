<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Colegiado;
use \App\Entity\Outros;

if(!(($user['config'] == 2)  or ($user['adm'] == 1))){
  header('location: ../');
  exit;
}


$where_ce = "centro_id = '" . $user['ce_id'] . "'";
$lista = Colegiado::getRegistros($where_ce);


$qrYeas = 'select * from anos';
$anos =Outros::qry($qrYeas);

include '../includes/header.php';

$tbl_dir = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Colegiado</th>
        <th class="align-top" colspan="'. count($anos).'"><center>Relatórios</center></th>
    </tr>
</thead>
<tbody>';


foreach( $lista as $coleg){
  $tbl_dir .= '
      <tr>
        <td>'. $coleg->nome .'</td>';
        foreach($anos as $y){
          $tbl_dir .= '
              <td><a href="./datac.php?id='.$coleg->id . $y->ano. '" class"btn-primary" > 📄'. $y->ano. '</a></td>' ;
        }
  $tbl_dir .= '
      </tr>' ;
}

$tbl_dir .= '</tbody></table>';




include './includes/lista_table.php';

include '../includes/footer.php';