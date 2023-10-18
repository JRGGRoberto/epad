<?php
  
$clock = [
  '🕛', '🕐', '🕑', '🕒', '🕓', '🕔', '🕕', '🕖', '🕗', '🕘', '🕙', '🕚'
];

$horas = date('H');
$horas >= 12 ? (int)($horas -= 12) : (int)($horas -= 0);

?>

<html lang="pt-BR"><head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!--multiselect CSS-->
    <link rel="stylesheet" type="text/css" href="../includes/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../includes/multi-select.css"> 
    <link rel="stylesheet" type="text/css" href="../includes/selectize.default.css">
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


  <nav class="navbar navbar-light text-center p-2" style="background-image: linear-gradient(0deg, #002661 6%, #007F3D 7%, #007F3D 9%, #FFFFFF 10%, #FFFFFF 80%, #D8D8D8 98%, #000000 99%); ">
    <div style="width: 100%">

         <div class="container text-center p-3">
            <div class="row">
              <div>
                <img src="https://sistemaproec.unespar.edu.br/sis/imgs/logo_unespar.png" class="d-inline-block align-top" alt="" loading="lazy" width="64" height="68">
              </div>
              <div class="col">
                  <div class="text-left">
                    Pró-Reitoria de
                  </div>
                  <div class="text-left">
                      <a href="../" style="color: #002661;"><strong>Extensão e Cultura - PROEC</strong></a>
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
                  <div>
              </div>

         </div>
    </div>     
  </nav>
  <div class="container">
