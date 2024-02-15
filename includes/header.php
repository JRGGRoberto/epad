<?php
  
require '../vendor/autoload.php';

use \App\Session\Login;
$obUsuario = Login::getUsuarioLogado();
use \App\Entity\Cargo;

$clock = [
  '🕛', '🕐', '🕑', '🕒', '🕓', '🕔', '🕕', '🕖', '🕗', '🕘', '🕙', '🕚'
];

$horas = date('H');
$horas >= 12 ? (int)($horas -= 12) : (int)($horas -= 0);

  $nome = explode(' ',trim($obUsuario['nome']));
  $nome = $nome[0]; // will print Test
 
?>

<!doctype html>
<html lang="pt-BR">
  <head>
  <title>ePAD UNESPAR </title>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  
  
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
                      <a  href="../" style="color: #002661;"><strong><span style="color: #002661;">PRO</span><span style="color: #007F3D;">GRAD</span> Pró-Reitoria de Ensino de Graduação</strong></a>
                  </div>
                  <div class="text-left">
                    Universidade Estadual do Paraná
                  </div>
                  
              </div>
            </div>

            <div class="col">
                  
                  <div>
                      <span class="badge badge-success">ePAD <?=$clock[$horas]?></span>
                  </div>
                  <div>
                     Plano de Atividades Docentes
                  </div>
                  <div><sup>ver<strong>0.0.01b</strong></sup></div>

                  
              </div>
<?php 
    if (!is_null($obUsuario['nome'])){

    $tpuser;
    if($obUsuario['tipo'] == 'prof'){
      $tpuser = 'professor';
    } elseif($obUsuario['tipo'] == 'agente'){
      $tpuser = 'agente';
    } else {

    }
    $ano = 2024;
?>

              <div class="btn-group btn-group-sm float-right">  
                    <?php
                       if($obUsuario['tipo'] === 'prof'){
                         echo '<a type="button" class="btn btn-primary" href="../pad" style="text-align: center;">Meu PAD</a>';

                         $where = ("(ano, id_prof ) = ('".$ano."', '".$obUsuario['id']."')");
                         $cargos = Cargo::gets($where); 
                         if (sizeof($cargos) > 0){
                            echo '<div class="btn-group btn-group-sm">';
                            echo '   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Atribuir</button>';
                            echo '   <div class="dropdown-menu dropdown-menu-left">';
                            $opcaoMenu = '';
                            foreach($cargos as $c){
                              switch($c->tipocod){
                               case 'a': 
                                  $opcaoMenu = 'Orientação ao Estágio ';
                                  break;
                               case 'b': 
                                  $opcaoMenu = 'Orientação de Aulas Práticas em Saúde';
                                  break;
                               case 'c': 
                                  $opcaoMenu = 'Orientação à Trabalhos acadêmicos';
                                  break;
                               case 'd': 
                                  $opcaoMenu = 'Orientação de Monitoria.';
                                  break;
                              }
                              echo '<a class="dropdown-item btn-sm" href="../attribs2/index.php?t='.$c->tipocod.'" >'.$opcaoMenu.'</a>';
                            }

                            echo '   </div>';
                            echo '</div>';
                         }


                         if($obUsuario['config'] === '1'){
                           ?>
                              <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Coordenação</button>
                                <div class="dropdown-menu dropdown-menu-left">
                                  <a class="dropdown-item btn-sm" href="../curso" >Aulas</a>
                                  <a class="dropdown-item btn-sm" href="../attribs" >Atribuir funções</a>
                                  <a class="dropdown-item btn-sm" href="../aprovc" >Assinar ver PADs</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item btn-sm" href="#">Informações</a>
                                </div>
                              </div>
                          <?php
                         } elseif ($obUsuario['config'] === '2'){
                           ?>
                              <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Direção</button>
                                <div class="dropdown-menu dropdown-menu-left">
                                  <a class="dropdown-item btn-sm" href="../aprovc" >Assinar ver PADs</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item btn-sm" href="#">Relatórios</a>
                                </div>
                              </div>
                          <?php
                         }

                       } elseif($obUsuario['tipo'] === 'agente'){
                         echo '<a type="button" class="btn btn-primary" href="../matrizes" style="text-align: center;">Matrizes</a>';
                       }
                       if(1>2){
                         echo '<a type="button" class="btn btn-primary" href="../vinculo" style="text-align: center;">Vinculos</a>';
                       }
                    ?>
                  <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">👤 <?= $nome ?></button>
                    <div class="dropdown-menu dropdown-menu-right">
                       <a class="dropdown-item btn-sm" href="../<?= $tpuser ?>/editar.php?id=<?= $obUsuario['id'] ?>">Perfil</a> 
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
  </nav>

    <div class="container">
<?php 

    if (!is_null($obUsuario['nome'])){
      echo 
                   "<span class='badge badge-primary' id='bca'>",   $obUsuario['tipo'],
        "</span><span class='badge badge-secondary' id='bce'>", $obUsuario['lota_nome'],
       // "</span><span class='badge badge-success' id='bco'>",   $obUsuario['colegiado'],
        "</span><span class='badge badge-info'>",      $obUsuario['nome'],"</span></a>";
/*
      if($obUsuario['niveln'] > 0){
        echo "<span class='badge badge-warning float-right'>", $obUsuario['nivel'],"</span>";
      }

      if($obUsuario['adm'] == 1){
        echo "<span class='badge badge-danger float-right'>Admin</span>";
      }
*/
    }
    


  ?>