<?php

require '../vendor/autoload.php';
use App\Entity\Professor;
use App\Session\Login;

// Obriga o usuário a estar logado
Login::requireLogin();
$user = Login::getUsuarioLogado();

if (!$user['adm'] == 1) {
    header('location: ../');
    exit;
}

define('TITLE', 'Cadastrar Professor');

$obProfessor = new Professor();
$obProfessor->niveln = 0;
$obProfessor->ativo = 1;

// VALIDAÇÃO DO POST
if (isset($_POST['nome'])) {
    // $obProfessor->id = $_POST['id'];
    $obProfessor->nome = strtoupper($_POST['nome']);
    $obProfessor->cpf = $_POST['cpf'];
    $obProfessor->telefone = $_POST['telefone'];
    $obProfessor->lattes = $_POST['lattes'];
    $obProfessor->titulacao = $_POST['titulacao'];
    $obProfessor->email = $_POST['email'];
    $obProfessor->id_colegiado = $_POST['id_colegiado'];
    $obProfessor->cat_func = $_POST['cat_func'];
    $obProfessor->ativo = $_POST['ativo'];
    $obProfessor->adm = $_POST['adm'];
    $obProfessor->user = $_POST['user'];
    if (strlen($_POST['senha']) > 0) {
        $obProfessor->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }

    $obProfessor->cadastrar();

    header('location: index.php?status=success');
    exit;
}

$CAop = '';
$CEop = '';
$COop = '';
$script = '<script>';

if ($user['adm'] != 1) {
    switch ($user['niveln']) {
        case 1:
            $CAop = "<option value='".$user['ca_id']."' readonly class='xpto1'>".$user['campus'].'</option>';
            $script .= 'var ce = document.querySelector("#ce");';
            $script .= 'var co = document.querySelector("#co");';
            $script .= 'pegarCE("'.$user['ca_id'].'");';
            break;
        case 2:
            $CAop = "<option value='".$user['ca_id']."' readonly class='xpto2'>".$user['campus'].'</option>';
            $CEop = "<option value='".$user['ce_id']."' readonly class='xpto2'>".$user['centros'].'</option>';
            $script .= 'var co = document.querySelector("#co");';
            $script .= 'pegarCO("'.$user['ce_id'].'");';
            break;
        case 3:
            $CAop = "<option value='".$user['ca_id']."' readonly class='xpto3'>".$user['campus'].'</option>';
            $CEop = "<option value='".$user['ce_id']."' readonly class='xpto3'>".$user['centros'].'</option>';
            $Coop = "<option value='".$user['co_id']."' readonly class='xpto3'>".$user['colegiado'].'</option>';
            break;
    }
} elseif ($user['adm'] == 1) {
    $script .= 'var ca = document.querySelector("#ca");';
    $script .= 'var ce = document.querySelector("#ce");';
    $script .= 'var co = document.querySelector("#co");';
    $script .= 'pegarCA();';
}
$script .= '</script>';

$padsv = '';

$infoMail = ['', ''];

$selectCat = '<div class="col-2">
          <div class="form-group">
            <label for="cat_func">Categoria funcional</label>
            <select name="cat_func" id="cat_func" class="form-control" required="">
                <option value="e">Efetivo</option>
                <option value="c">Colaborador</option>
                <option value="d">Definir</option>
			      </select>
          </div> 
        </div>';

include '../includes/header.php';
include __DIR__.'/includes/formulario.php';
include '../includes/footer.php';
