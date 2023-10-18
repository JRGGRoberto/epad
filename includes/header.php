<?php
  
require '../vendor/autoload.php';

use \App\Session\Login;
$obUsuario = Login::getUsuarioLogado();

$clock = [
  '🕛', '🕐', '🕑', '🕒', '🕓', '🕔', '🕕', '🕖', '🕗', '🕘', '🕙', '🕚'
];

$horas = date('H');
$horas >= 12 ? (int)($horas -= 12) : (int)($horas -= 0);



  $adminOpts = '';
  // if ($obUsuario[adm] == 1 or in_array($obUsuario[nivel], $cargAdm ) ){
  if ($obUsuario['adm'] == 1 or $obUsuario['niveln'] > 0  ){
    $adminOpts = 
      "<div class='btn-group btn-group-sm'>
        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
        🔧 Administração
        </button>
        <div class='dropdown-menu'>";
  /* Todos os Adminstradores ou de nível de chefia pode Listar professores, cadastrá-los ou [excluí-los]**?
  E passar seu cargo
  */
    $adminOpts .= "<a class='dropdown-item btn-sm' href='../professor'>Listar Professores</a>";
    $adminOpts .= "<a class='dropdown-item btn-sm' href='../professor/cadastrar.php'>Cadastrar Professor</a>";
    // $adminOpts .= "<a class='dropdown-item btn-sm disabled' href='#'>Passar o posto para outro professor</a>";

    if (($obUsuario['niveln']<3) or ($obUsuario['adm']== 1)){
      $adminOpts .= "<a class='dropdown-item btn-sm' href='../hierarquia/index.php?hi=cnf'>Configurar hierarquia</a>";
    }
    $adminOpts .= 
      "  </div>
      </div>";
  }

  $nome = explode(' ',trim($obUsuario['nome']));
  $nome = $nome[0]; // will print Test
 
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <link href="https://sistemaproec.unespar.edu.br/sistema/includes/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://sistemaproec.unespar.edu.br/sistema/includes/summernote-bs4.min.js"></script>

  
    <!--multiselect CSS-->
    <link rel="stylesheet" type="text/css" href="../includes/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="../includes/multi-select.css" /> 
    <link rel="stylesheet" type="text/css" href="../includes/selectize.default.css" />
    <script type="text/javascript">

$(function($) {
    // Quando enviado o formulário
    $("#upload").submit(function() {
        // Passando por cada anexo
        $("#anexos").find("li").each(function() {
            // Recuperando nome do arquivo
            var arquivo = $(this).attr('lang');
            // Criando campo oculto com o nome do arquivo
            $("#upload").prepend('<input type="hidden" name="anexos[]" value="' + arquivo + '" \/>');
        }); 
    });
});
    
// Função para remover um anexo
function removeAnexo(obj) 
{
    // Recuperando nome do arquivo
    var arquivo = $(obj).parent('li').attr('lang');
    // Removendo arquivo do servidor
    $.post("index.php" | "cadastrar.php", {acao: 'removeAnexo', arquivo: arquivo}, function() {
        // Removendo elemento da página
        $(obj).parent('li').remove();
    });
}
    </script>
<style type="text/css">

iframe {
    border: 0;
    overflow: hidden;
    margin: 0;
    height: 60px;
    width: 450px;
}

#anexos {
    list-style-image: url(../imgs/file.png);
}

#anexos_edt {
    list-style-image: url(../imgs/file.png);
}

img.remover {
    cursor: pointer;
    vertical-align: bottom;
}
</style>

<title>SisGP PROEC</title>
  </head>
  <body class="bg-light text-dark">

<!-- 
-->
  <nav class="navbar navbar-light text-center p-2" style="background-image: linear-gradient(0deg, #002661 6%, #007F3D 7%, #007F3D 9%, #FFFFFF 10%, #FFFFFF 80%, #D8D8D8 98%, #000000 99%); ">
    <div style="width: 100%">

         <div class="container text-center p-3" >
            <div class="row">
              <div>
                <img src="../imgs/logo_unespar.png" width="64" height="68" class="d-inline-block align-top" alt="" loading="lazy">
              </div>
              <div class="col">
                  <div class="text-left">
                    Pró-Reitoria de
                  </div>
                  <div class="text-left">
                      <a  href="../" style="color: #002661;"><strong>Extensão e Cultura - PROEC</strong></a>
                  </div>
                  <div class="text-left">
                    Universidade Estadual do Paraná
                  </div>
                  
              </div>
            </div>

            <div class="col">
                  
                  <div>
                      <span class="badge badge-success">SisGP <?=$clock[$horas]?></span>
                  </div>
                  <div>
                    Sistema para Gerir Projetos
                  </div>
                  <div><sup>ver<strong>1.5b</strong></sup></div>

                  
              </div>
            <div class="btn-group">
            <?php 
    if (!is_null($obUsuario['nome'])){
      ?>
      <div class="btn-group btn-group-sm float-right">   
      <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Propostas
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item btn-sm" href="../projetos/cadastrar.php?t=4">Novo Programa</a>
          <a class="dropdown-item btn-sm" href="../projetos/cadastrar.php?t=5">Novo Projeto</a>
          <a class="dropdown-item btn-sm" href="../projetos/cadastrar.php?t=3">Nova Prestação de Serviço</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item btn-sm" href="../projetos/cadastrar.php?t=1">Novo Curso</a>
          <a class="dropdown-item btn-sm" href="../projetos/cadastrar.php?t=2">Novo Evento</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item btn-sm" href="../projetos">Listar minhas propostas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item btn-sm" href="../projetostb">Listar todos os projetos aprovados</a>
        </div>
      </div>

      <div class="btn-group btn-group-sm">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Avaliações
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item btn-sm" href="../avalareal">A realizar</a>
          <a class="dropdown-item btn-sm" href="../avalfeitas">Realizadas</a>
        </div>
      </div>

      <?=$adminOpts?>
<!--
      <button type="button" class="btn btn-primary">Projetos</button>
    -->  

      <div clastoasts="btn-group btn-group-sm">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        👤 <?= $nome ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item btn-sm" href="../professor/editar.php?id=<?=$obUsuario['id']?>">Perfil</a>
    <!--      <a class="dropdown-item btn-sm" href="../config/">Configuração</a>  --> 
          <div class="dropdown-divider"></div>
          <a class="dropdown-item btn-sm" href="../login/logout.php">Sair</a>
        </div>
      </div>
    </div>
<?php 
    }
  ?>

            </div>
         </div>
    </div>     
  </nav>

    <div class="container">
<?php 

    if (!is_null($obUsuario['nome'])){
      echo 
                   "<a href='../hierarquia/index.php?hi=ca' data-toggle='tooltip' title='Hierarquia do campus' style='text-decoration:none;'><span class='badge badge-primary' id='bca'>",   $obUsuario['campus'],
        "</span></a><a href='../hierarquia/index.php?hi=ce' data-toggle='tooltip' title='Hierarquia do centro de área' style='text-decoration:none;'><span class='badge badge-secondary' id='bce'>", $obUsuario['centros'],
        "</span></a><a href='../hierarquia/index.php?hi=co' data-toggle='tooltip' title='Hierarquia do colegiado' style='text-decoration:none;'><span class='badge badge-success' id='bco'>",   $obUsuario['colegiado'],
        "</span></a><a href='../professor/editar.php?id=", $obUsuario['id'],"' data-toggle='tooltip' title='Perfil do usuário' style='text-decoration:none;'><span class='badge badge-info'>",      $obUsuario['nome'],"</span></a>";

      if($obUsuario['niveln'] > 0){
        echo "<span class='badge badge-warning float-right'>", $obUsuario['nivel'],"</span>";
      }

      if($obUsuario['adm'] == 1){
        echo "<span class='badge badge-danger float-right'>Admin</span>";
      }

    }

  ?>