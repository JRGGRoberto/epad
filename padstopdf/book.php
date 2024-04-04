<?php
require '../vendor/autoload.php';

use \App\Entity\Vinculo;
use \App\Entity\Outros;
use \App\Entity\PADAtiv22;
use \App\Entity\PADAtiv23;
use \App\Entity\PADAtiv3;
use \App\Entity\PADAtiv4;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

$co = $_GET["co"];

if($user['co_id'] !== $co ){
  echo 'Apenas coordenadores podem executar essa função. '; 
 // header('location: ../../');
  exit;
}
echo 'Aguarde...';

function gerarPad($id){
  $vinc = Vinculo::get($id);
  $where = ' vinculo = "'. $vinc->id . '" ';
  $sql = 'select * from pad21d where '. $where . ' order by atividade, disciplina';
  $pad21 = Outros::qry($sql);
  $pad22 = PADAtiv22::get($where);
  $pad23 = PADAtiv23::get($where);
  $pad3  = PADAtiv3::get($where);
  $pad4  = PADAtiv4::get($where);

  include __DIR__.'/includes/body1.php';
  include __DIR__.'/includes/pad1.php';
  include __DIR__.'/includes/pad21.php';
  include __DIR__.'/includes/pad22.php';
  include __DIR__.'/includes/pad23.php';
  include __DIR__.'/includes/pad3.php';
  include __DIR__.'/includes/pad4.php';
  include __DIR__.'/includes/pad5.php';
  include __DIR__.'/includes/pad6.php';
  include __DIR__.'/includes/pad7.php';
  include __DIR__.'/includes/footer1.php';
}


$w=  "co_id = '". $co ."'";
$o = " nome ";
$pads = Vinculo::gets($w, $o );


ob_start();
include __DIR__.'/includes/hea1.php';

foreach($pads as $pa){
    gerarPad($pa->id);
}

include __DIR__.'/includes/fim.php';
$html = ob_get_clean();


use Dompdf\Dompdf;
$dompdf = new Dompdf(['enable_remote' => true]);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("documento.pdf", array("Attachment" => false));
//$dompdf->stream("meu_pad.pdf");
