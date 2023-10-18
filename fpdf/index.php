<?php
require('fpdf.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PDF extends FPDF
{
// Page header
function Header()
{
 
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    if($this->page > 1) {
       $this->Image('../imgs/logo.jpg', 20,18,25);
       $this->Image('../imgs/proec.png',100,18,40);
    } else {
       $this->Image('../imgs/logo.jpg', 90,18,30);
       //$this->Cell(30,10,'Title',1,0,'C'); 
    }
    // Line break
    $this->Ln(48);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0,10,'ANEXO II', 0, 2 , 'C');

$pdf->SetFont('Arial', '', 11);
$str = 'FORMULÁRIO PARA ELABORAÇÃO DE PROPOSTAS DE PROGRAMAS, 
PROJETOS OU PRESTAÇÃO DE SERVIÇO';
$txt = iconv('UTF-8', 'windows-1252', $str);
$pdf->MultiCell(0,5,$txt, 0, 'C');
// Line break
$pdf->Ln();




$pdf->SetFont('Times','',12);
for($i=1;$i<=20;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>