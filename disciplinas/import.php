<?php

require '../vendor/autoload.php';
use App\Entity\Disciplinas;
use App\Entity\MatrizDisc;

/**
 *  use o https://excel2json.io/.
 */
$url_corrente = $_POST['url_corrente'];
$id_master = $_POST['id_master'];
$user = $_POST['uid_imp'];

$dados = $_POST['import_json'];
$arrEq = json_decode($dados, true);
$index = 1;
$chTotal = 0;
$nome = '';
foreach ($arrEq as $key => $data) {
    $s = $data['Série'];
    $dis = new Disciplinas();
    $dis->id_matriz = $id_master;
    $dis->nome = $data['Disciplinas'];
    $dis->ch = str_replace('h', '', $data['Cargahoraria']);
    $dis->user = $user;
    $dis->serie = substr($s, 0, 1);

    $id = $dis->cadastrar();
    $chTotal += $dis->ch;
    $nome = $data['Matriz'];
    ++$index;
}

$matriz = MatrizDisc::getById($id_master);
$matriz->nome = $nome;
$matriz->ch = $chTotal;
$matriz->atualizar();

header('location: '.$url_corrente);
exit;
