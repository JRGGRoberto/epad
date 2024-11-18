<?php

require '../vendor/autoload.php';


use App\Session\Login;

$obUsuario = Login::getUsuarioLogado();
use App\Entity\Cargo;
use \App\Entity\Outros;


$clock = [
  '🕛', '🕐', '🕑', '🕒', '🕓', '🕔', '🕕', '🕖', '🕗', '🕘', '🕙', '🕚',
];

$horas = date('H');
$horas >= 12 ? (int) ($horas -= 12) : (int) ($horas -= 0);

$nome = explode(' ', trim($obUsuario['nome']));
$nome = $nome[0]; // will print Test

$idu = $obUsuario['id'];
  
$qry1 = "
  select 
    c.id id , c.nome curso , a.ano ano , a.edt edt ,
    CONCAT(c.nome,  '[', a.ano, ']' ) nomelongo
  from 
    colegiados c,
    anos a
  where 
     (c.coord_id, a.edt) = ('". $idu ."', 1)
  order by a.ano desc, c.nome
  ";
$coodAnos = Outros::qry($qry1);


$btnCurs = '';
$idCurso = '';
$nomeCurso = '';
$anoCurso = '';


$qnty = 0;
foreach($coodAnos as $curs){
    $act = '';
    $ck = '';
  
    if($obUsuario['year_sel'] == '' and $qnty == 0){
      $act = 'active';
      $ck = 'checked';
    }
  
    if($obUsuario['year_sel'] == $curs->ano and $obUsuario['id_coSel']  == $curs->id){
      $act = 'active';
      $ck = 'checked';
    }
   
  
    $btnCurs .=  '<label class="btn btn-primary '.$act.' btn-sm">';
    $btnCurs .= '<input type="radio" name="radioAC" '.$ck.' value="'. $curs->ano . $curs->id .'"  onclick="chValueS(`'.$curs->ano . $curs->id .'`);"  >'. $curs->nomelongo.'
    </label>';
  
    if($act == 'active') {
      $idCurso = $curs->id;
      $nomeCurso = $curs->curso;
      $anoCurso = $curs->ano;
    }
  
    $qnty++;
}

$scriptSel1opcao = '';

if(($obUsuario['year_sel'] == '' or $obUsuario['year_sel'] == null) and $qnty > 0 ){

  $scriptSel1opcao = 
    "<script>
      chValueS(`".$anoCurso . $idCurso ."`);
    </script>";
}

if ($qnty == 0 and $obUsuario['config'] == '2'){
  $qry1 = "select * from anos a where a.edt =  1  order by a.ano desc  ";
  $coodYY = Outros::qry($qry1);
  $qntyCE = 0;
  foreach($coodYY as $Ys){
    $act = '';
    $ck = '';
  
    if($obUsuario['year_sel'] == '' and $qntyCE == 0){
      $act = 'active';
      $ck = 'checked';
    }
  
    $btnCurs .=  '<label class="btn btn-primary '.$act.' btn-sm">';
    $btnCurs .= '<input type="radio" name="radioAC" '.$ck.' value="'. $Ys->ano .'"  onclick="chValueS(`'.$Ys->ano .'`);"  >'. $Ys->ano.'
    </label>';
  
    if($act == 'active') {
      $anoCurso = $Ys->ano;
    }
  
    $qntyCE++;
  }
  if(($obUsuario['year_sel'] == '' or $obUsuario['year_sel'] == null) and $qntyCE > 0 ){

    $scriptSel1opcao = 
      "<script>
        chValueS(`".$anoCurso ."`);
      </script>";
  }


}

/*

echo 'id:   '. $idCurso .'<br>';
echo 'curs: '. $nomeCurso .'<br>';
echo 'ano:  '. $anoCurso .'<br>';
echo '<hr>';

echo '<pre>';
print_r($obUsuario);
echo '</pre>';
*/

?>

<!doctype html>
<html lang="pt-BR">
  <head>
  <title>ePAD UNESPAR </title>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <!--   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="../includes/bootstrap.min.css">

  <!-- 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
-->
  <script src="../includes/jquery.min.js"></script>
  <script src="../includes/popper.min.js"></script>
  <script src="../includes/bootstrap.bundle.min.js"></script>
  
  
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
                      <span class="badge badge-success">ePAD <?php echo $clock[$horas]; ?></span>
                  </div>
                  <div>
                     Plano de Atividades Docentes
                  </div>
                  <div><sup>ver<strong>0.0.01b</strong></sup></div>

                  
              </div>
<?php
    if (!is_null($obUsuario['nome'])) {
        if ($obUsuario['tipo'] == 'prof') {
            $tpuser = 'professor';
        } elseif ($obUsuario['tipo'] == 'agente') {
            $tpuser = 'agente';
        } else {
          header('location: ./branco.php');
          exit;
        }
      
        ?>
<div> 
  <div>


  

  </div>
  <!-- inicio botões menu -->
              <div class="btn-group btn-group-sm float-right">  
                    <?php
                               if ($obUsuario['tipo'] === 'prof') {
                                   echo '<a type="button" class="btn btn-primary" href="../home" style="text-align: center;">PAD</a>';

                                   // $where = ("(ano, id_prof ) = ('".$ano."', '".$obUsuario['id']."')");
                                   $where = ("(id_prof, edtano ) = ('".$obUsuario['id']."', 1)");
                                   $cargos = Cargo::gets($where);
                                   if (sizeof($cargos) > 0) {
                                       echo '<div class="btn-group btn-group-sm">';
                                       echo '   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Orientação</button>';
                                       echo '   <div class="dropdown-menu dropdown-menu-left">';
                                       $opcaoMenu = '';
                                       foreach ($cargos as $c) {
                                           switch ($c->tipocod) {
                                               case 'a':
                                                   $opcaoMenu = 'Orientação ao Estágio';
                                                   break;
                                               case 'b':
                                                   $opcaoMenu = 'Orientação de Aulas Práticas em Saúde';
                                                   break;
                                               case 'c':
                                                   $opcaoMenu = 'Orientação à Trabalhos acadêmicos';
                                                   break;
                                               case 'd':
                                                   $opcaoMenu = 'Orientação de Monitoria';
                                                   break;
                                               case 'e':
                                                   $opcaoMenu = 'Orientação de estudante em PIC/PIBIC';
                                                   break;
                                               case 'f':
                                                   $opcaoMenu = 'Orientação de estudante em PIBEX/PIBIS';
                                                   break;
                                           }
                                           echo '<a class="dropdown-item btn-sm" href="../attribs2/index.php?t='.$c->tipocod.$c->id.'" >'.$opcaoMenu.' - '.$c->colegiado_tt.' ['.$c->ano.']</a>';
                                       }
                                       echo '   </div>';
                                       echo '</div>';
                                   }

                                   if ($obUsuario['config'] === '1' and $qnty > 0) {
                                    ?> 


                              <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Coordenação</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item btn-sm" href="../curso" >Atribuir Aulas</a>
                                    
                                  <div class="dropdown-divider"></div>
                                  
                                  <a class="dropdown-item btn-sm" href="../attribs" >Atribuir Funções [<?=$nomeCurso?> - <?=$anoCurso?>]</a>
                                  <a class="dropdown-item btn-sm" href="../attribspem" >Atribuir Projetos de ensino ou Monitorias [<?=$nomeCurso?> - <?=$anoCurso?>]</a>

                                  <a class="dropdown-item btn-sm" href="../aprovc" >Visualizar e Assinar PADs [<?=$nomeCurso?> - <?=$anoCurso?>]</a>
                                  <div class="dropdown-divider"></div>
                               <!--   <a class="dropdown-item btn-sm" href="../cursoTm/" rel="noopener noreferrer">Solicitações de inclusões ou alterações de disciplinas [<?=$nomeCurso?> - <?=$anoCurso?>]</a> -->
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item btn-sm" href="../infos">Relatórios [<?=$nomeCurso?> - <?=$anoCurso?>]</a>
                                </div>
                              </div>
                          <?php
                                   } elseif ($obUsuario['config'] === '2') {
                                       ?>
                              <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Direção</button>
                                <div class="dropdown-menu dropdown-menu-left">
                                  <a class="dropdown-item btn-sm" href="../aprovc" >Homologar ver PADs</a>
                           
                                  <a class="dropdown-item btn-sm" href="../infos">Relatórios</a> 
                                </div>
                              </div>
                          <?php
                                   }
                               } elseif ($obUsuario['tipo'] === 'agente') {
                                   if($user['adm'] == 1 ) {
                                     echo '<a type="button" class="btn btn-primary" href="../matrizes" style="text-align: center;">Matrizes</a>';
                                   }
                                   echo '<a type="button" class="btn btn-primary" href="../infos/listaall.php" style="text-align: center;">Dados</a>';
                               }
                               if (1 > 2) {
                                   echo '<a type="button" class="btn btn-primary" href="../vinculo" style="text-align: center;">Vinculos</a>';
                               }
        ?>


<?php

// colocar via tabela de suporte!!!
$galeraDoSuporte = [
  'b8fa555f-cedb-47cf-91cc-7581736aac88', // Roberto
  '8154fff1-becd-11ee-801b-0266ad9885af',   // Sérgio
  '81512d7d-becd-11ee-801b-0266ad9885af'];   // Dorigão

        if (in_array($obUsuario['id'], $galeraDoSuporte)) { ?>

                              <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Suporte</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item btn-sm" href="../listapads" >Lista ProfPADs</a>
                            <!--       <a class="dropdown-item btn-sm" href="../mensagens" >Mensagens</a>  -->
                                  <a class="dropdown-item btn-sm" href="../horas" >Relação de horas Matrizes/Semanal</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item btn-sm" href="../infos/listaall.php">Dados</a>
                                 

                                  
                             <!--      -->
                                </div>
                              </div>


<?php
        }
        ?> 
                  <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">👤 <?php echo $nome; ?></button>
                    <div class="dropdown-menu dropdown-menu-right">
                       <a class="dropdown-item btn-sm" href="../<?php echo $tpuser; ?>/editar.php?id=<?php echo $obUsuario['id']; ?>">Perfil</a> 
<?php if ($obUsuario['tipo'] == 'prof') { ?> 
  <!-- ?= $user['AnoAtivo'] ?> -->
                       <a class="dropdown-item btn-sm" href="../dadosvinc/">Informações do meu PAD [cabeçalho 1.]</a>
  
  <?php } ?> 

                       <div class="dropdown-divider"></div>
                     <!--  <a class="dropdown-item btn-sm" href="../faleconosc" >Fale conosco</a> -->
                      <!--                        <a class="dropdown-item btn-sm" target="_blank" href="https://forms.gle/p8925m6eNxrard5aA" rel="noopener noreferrer">Fale conosco  </a> -->
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item btn-sm" href="../login/logout.php">Sair</a>
                    </div>
                  </div>
              </div>
<?php
    }
?> 

    <div><!-- Fim botões menu -->

<?php
//if ($obUsuario['config'] === '1') {
if( in_array($obUsuario['config'],['1', '2']) ){
  echo '<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">';
  echo $btnCurs;
  echo '</div>';
}
?>
<script>

function chValueS(yearIDCO){
  
  const data = {
    ano: yearIDCO.substr(0, 4),
    coid: yearIDCO.substr(4, 36)
  };
 

  fetch('./../includes/dml/chSess.php', {
        method:'PUT',
        headers:{
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then( res => res.json())
    .then( res => {
           console.log(res.data.ano);
           console.log(res.data.co);
           window.location.reload();
        }
    );
}

</script>

<?= $scriptSel1opcao ?>

</div>
</div>

         </div>
    </div> 
  </nav>

    <div class="container">
<?php

    if (!is_null($obUsuario['nome'])) {
        echo "<span class='badge badge-primary' id='bca'>",   $obUsuario['tipo'],
        "</span><span class='badge badge-secondary' id='bce'>", $obUsuario['ce_nome'],
        // "</span><span class='badge badge-success' id='bco'>",   $obUsuario['colegiado'],
        "</span><span class='badge badge-info'>",      $obUsuario['nome'],'</span></a>';
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