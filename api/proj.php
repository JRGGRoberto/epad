<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

$prj = $_GET["prj"];

$id = substr ($prj, 3, 36);
$ver = substr ($prj, 40, strlen($prj));

$where = '(id, ver) = ("' .$id.'", '.$ver.') ';

use \App\Entity\Projeto;

$registros = Projeto::getRegistros($where);
$registro = $registros[0];
echo json_encode($registro);
