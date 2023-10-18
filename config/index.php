<?php

require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Rules;

Login::requireLogin();
$user = Login::getUsuarioLogado();
$rules = Rules::getRegraVigente();



$navTabs   = '';
$tabPanes  = '';
$cont = 0;
$fadeactive = 'active';
$activeOr = 'active';

foreach($rules as $r){
    // file_get_contents('../dinamico/' . );

    $navTabs .=
    '<li class="nav-item">
      <a class="nav-link '.$activeOr.'" data-toggle="tab" href="#n'.$r->id .'">'.$r->label .'</a>
    </li>';

    $activeOr = '';

    $tabPanes .= 
    '<div id="n'.$r->id .'" class="container tab-pane '. $fadeactive .'">';

    ob_start();
    require "../dinamico/$r->arquivo";
    $tmp = ob_get_clean();
    $tabPanes .= $tmp; // file_get_contents("../dinamico/$r->arquivo");

    $tabPanes .= '</div>';

    $fadeactive = 'fade';
}


include '../includes/header.php';
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php'; 