<?php

require '../vendor/autoload.php';

use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

$galeraDoSuporte = [
    'b8fa555f-cedb-47cf-91cc-7581736aac88', // Roberto
    '8154fff1-becd-11ee-801b-0266ad9885af',   // Sérgio
    '8151fc77-becd-11ee-801b-0266ad9885af',    // ELIANE PAGANINI DA SILVA
    '81512d7d-becd-11ee-801b-0266ad9885af'];   // Dorigão

if (!in_array($user['id'], $galeraDoSuporte)) {
    header('location: ../home/');
    exit;
}

use App\Entity\FaleConosco;

$where = ' sistema = "epad" ';
$order = '  data_envio DESC ';
$mensagens = FaleConosco::get($where, $order);

$tab = '';
$limit = 100;
foreach ($mensagens as $msg) {
    if (strlen($msg->msg) > $limit) {
        $msg->msg = substr($msg->msg, 0, $limit).'...';
    }
    $style = '';
    if ($msg->respostas == 0) {
        $style = 'style="font-weight: bold;"';
    }

    $tab .= '<tr '.$style.' >';
    $tab .= '<td>'.$msg->solicitante.'<br><sup>'.$msg->local.'</sup></td> ';
    $tab .= '<td>'.$msg->assunto.'</td>';
    $tab .= '<td>'.$msg->tp_msg.'</td>';
    $tab .= '<td  style="font-size: 12px;"><a href="./msg.php?t='.$msg->id.'">'.$msg->msg.'</a> </td>';
    $tab .= '</tr>';
}

include '../includes/header.php';
include __DIR__.'/includes/lista.php';
echo '<pre>';
print_r($user);
echo '</pre>';
include '../includes/footer.php';
