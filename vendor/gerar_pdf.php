<?php

// Carregar o Composer
require './vendor/autoload.php';

$url = "https://$_SERVER[HTTP_HOST]";

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet'$url/pdf-php/css/custom.css'>";
$dados .= "<title>Celke - Gerar PDF</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar os Usuário</h1>";
$dados .= "<h2>";
$dados .= $url;
$dados .= "</h2>";
$dados .= "<h2>";
$dados .= "</h2>";


//               /home/sistemaproec/www/pdf-php
//  https://sistemaproec.unespar.edu.br/pdf-php/imagens/celke.jpg



$dados .= "<img src='$url/pdf-php/imagens/celke.jpg'><br>";
$dados .= "O PHP proin iaculis, libero et dictum fringilla, ex metus scelerisque mauris, sit amet lobortis enim justo quis arcu. Proin eget pharetra ipsum, eget auctor purus.";
$dados .= "link rel='stylesheet'$url/pdf-php/css/custom.css'";
$dados .= "</body>";



// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
