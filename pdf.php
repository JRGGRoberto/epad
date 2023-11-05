<?php

// Carregar o Composer
require './vendor/autoload.php';
 
$txt_file = fopen('pdf.html','r');
$html = '';

while ($line = fgets($txt_file)) {
  $html .= $line;
}
fclose($txt_file);
    
use Dompdf\Dompdf;
$dompdf = new Dompdf(['enable_remote' => true]);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("AE1.pdf");