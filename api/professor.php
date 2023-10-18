<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Professor;
$where = '';

$op =    substr($_GET['wc'],0,1);
$campo = substr($_GET['wc'],1);

switch ($op) {
    case 'c':
        //cpf
        $where = 'cpf = "'.$campo.'"';
        break;
    case 'e':
        //email
        $where = 'email = "'.$campo.'"';
        break;
    case 't':
        //telefone
        $where = 'telefone = "'.$campo.'"';
        break;
 }

$registro = Professor::getProfessores($where, $order = null, $limit = 1);

echo json_encode($registro);
