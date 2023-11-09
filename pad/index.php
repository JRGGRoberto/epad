<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Entity\Vinculo;
if(!isset( $_GET['v'])){
    header('location: index.php?status=error');
    exit;
}
$id = $_GET['v'];

$vinc = Vinculo::getVinculo($id);

include '../includes/header.php';
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php';


