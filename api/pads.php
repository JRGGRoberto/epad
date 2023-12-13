<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Outros;

$var = $_GET["md"];
$ano = substr($var, 36, 4);
$co  = substr($var, 0, 36);


$sql = '
SELECT * 
FROM pad_sucinto 
WHERE 
   ano  = "'. $ano .'" 
   and co_id = "'. $co. '" ' ;
$registros = Outros::qry($sql);

echo json_encode($registros);
