<!doctype html>
<html lang="pt-BR">
  <head>
  <title>ePAD UNESPAR</title>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body class="bg-light text-dark">
  <div class="container">
    
  <table class="table table-borderless table-sm">
    <thead class="thead-light">
        <tr>
            <td><img src="../imgs/logo_unespar.png" width="64" height="68" class="d-inline-block align-top" alt="" loading="lazy"></td>
            <td style="text-align: center;"><strong>PLANO DE ATIVIDADES DOCENTES - PAD</strong><br>
            Instrução Normativa Conjunta 007/2019<br>
PROGESP/PROEC/PROGRAD</td>   
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<img src="../imgs/pdf.png" alt="PDF" class="float-right" height="20px" style= "opacity: 0.5; cursor: pointer" onclick="topdf();">

<script>

function topdf(){
    let urlParams = new URLSearchParams(window.location.search);
    let toGo = 'https://sistemaproec.unespar.edu.br/epad/padstopdf/index.php?';
    window.location.href = toGo + urlParams;
}

</script>