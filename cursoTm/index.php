<?php

require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Colegiado;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$ok = false;
$id_user = $user['id'];
$coordenador = Colegiado::getQntdRegistros('coord_id  =  "'.  $id_user .'"');

/*if($user['tipo'] === 'prof' ){
   if($user['config'] == '1'){
      $ok = true;
   }
}*/

if($coordenador > 0 ){
   $ok = true;
}

if(!$ok){
   header('location: ../home/');
   exit;
}

use \App\Entity\MatrizDisc;
$colegiados = Colegiado::getRegistros('coord_id  =  "'.  $id_user .'"');

// $where = ' (id_curso, ano) = ("'.$user['co_id']. '" , '.$ano.') ' ;
// $where = ' id_curso =  "'.$user['co_id']. '" ' ;

$ids_col = '';
foreach ($colegiados as $co){
   $ids_col .= "'". $co->id ."', ";
}
$where = " id_curso  in (".  substr($ids_col, 0, -2) . " )";

$reg = MatrizDisc::get($where, "ano desc, curso");


echo '<pre>';
print_r($reg);
echo '</pre>';

$turno = '';
$tbody = '';
$x = 0;
foreach ($reg as $r){
   $class = '';
   switch ($r->turno) {
      case 'm':
        $turno = 'Matutino';
        break;
      case 'v':
        $turno = 'Vespertino';
        break;
      case 'n':
        $turno = 'Noturno';
        break;
      case 'i':
        $turno = 'Integral';
        break;
      default:
        $turno = 'Não definido';
    };

    if($r->qnt_pre ==  $r->qnt_dis){
       $class = 'class="table-success"';
    }
    
    $tbody .= '<tr '.$class.'>';
    $tbody .= '<td>'.$r->ano .'</td><td>'.$r->curso .'</td>
               <td>'.$r->nome .'</td><td>'. $turno .'</td>
               <td style="text-align: center;">'. $r->qnt_pre .'/'. $r->qnt_dis .'</td>
               <td style="text-align:center;"><button type="button" class="btn btn-light btn-sm" onclick="window.location = `../disciplinasCh/index.php?id='.$r->id.'`" data-toggle="tooltip" data-placement="right" title="Configurar">⚙️</button>
               </td>';
    $tbody .= '</tr>';
    $x++;
} 
if ($x == 0){
   $tbody = '<tr>';
   $tbody .= '<td style="text-align:center;" colspan="6">Dados não atribuidos</td>';
   $tbody .= '</tr>';

}



include '../includes/header.php';
$uid = $user['id'];
include __DIR__.'/includes/content.php';
include '../includes/footer.php'; 