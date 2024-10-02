<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Outros;

$sql = "select UPPER(codcam) as ca, colegiado, co_id  from ca_ce_co ccc
order by 1, 2";
$lista = Outros::qry($sql);

include '../includes/header.php';

$tbl_dir = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Campus</th>
        <th class="align-top">Colegiado</th>
        <th class="align-top">Relatórios</th>
    </tr>
</thead>
<tbody>';


foreach( $lista as $coleg){
  $tbl_dir .= '
    <tr>
      <td>'. $coleg->ca .'</td>
      <td>'. $coleg->colegiado .'</td>
      <td><a href="./data.php?id='.$coleg->co_id. '" class"btn-primary" > 📄</a></td>
   </tr>' ;
}
$tbl_dir .= '</tbody></table>';

include './includes/lista_table.php';

include '../includes/footer.php';