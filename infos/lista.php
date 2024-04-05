<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Colegiado;

$where_ce = "centro_id = '" . $user['ce_id'] . "'";
$lista = Colegiado::getRegistros($where_ce);

include '../includes/header.php';

$tbl_dir = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Campus</th>
        <th class="align-top">Relatórios</th>
    </tr>
</thead>
<tbody>';


foreach( $lista as $coleg){
  $tbl_dir .= '
    <tr>
      <td>'. $coleg->nome .'</td>
      <td><a href="./data.php?id='.$coleg->id. '" class"btn-primary" > 📄</a></td>
   </tr>' ;
}
$tbl_dir .= '</tbody></table>';

include './includes/lista_table.php';

include '../includes/footer.php';