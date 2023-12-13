<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Outros;

$vc = $_GET["vc"];
$vc = str_replace(" ","", $vc );

$sql = 'select * from pad21d where vinculo = "'. $vc. '" order by disciplina, atividade';

$registros = Outros::qry($sql);
echo json_encode($registros);
