<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\FaleConosco;

$fale = new FaleConosco();
$fale->sistema = 'epad';


include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $url = $_POST['url']; 
    $fale->tipomsg =  $_POST['tipomsg'];
    $fale->url =  $url;
    $fale->msg =  $_POST['msg'];
    $fale->user = $user['id'];
    $fale->assunto =  $_POST['assunto'];
    $idresp = $fale->cadastrar();
    $parte = '';
    
    switch($url) {
        case 1: $parte = 'ePAD -  Geral';
          break;
        case 2: $parte = 'Meu PAD -  Cálculos';
          break;
        case 3: $parte = 'Meu PAD -  Item 1';
          break;
        case 4: $parte = 'Meu PAD -  Item 2';
          break;
        case 5: $parte = 'Meu PAD -  Item 2.2';
          break;
        case 6: $parte = 'Meu PAD -  Item 3';
          break;
        case 7: $parte = 'Meu PAD -  Item 4';
          break;
        case 8: $parte = 'Meu PAD -  Item 6';
          break;
        case 9: $parte = 'Coordenação - Matrizes';
          break;
        case 10: $parte = 'Coordenação - Distribuição de disciplinas';
          break;
        case 11: $parte = 'Coordenação - Atribuição de funções';
          break;
        case 12: $parte = 'Coordenação - Relatórios';
          break;
        case 13: $parte = 'Edição de dados do professor';
          break;
        case 14: $parte = 'Login';
          break;
        case 15: $parte = 'Outros';
          break;
    }


    $tp = '';
    switch ($fale->tipomsg) {
        case 1: $tp =  'Elogio';
        break;
        case 2: $tp =  'Dúvidas';
        break;
        case 3: $tp =  'Sugestão';
        break;
        case 4: $tp =  'Erro no sistema';
        break;
    }

    include __DIR__.'/includes/content.php';
    include '../includes/footer.php'; 
    exit;

}


include __DIR__.'/includes/form.php';
include '../includes/footer.php'; 

