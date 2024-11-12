<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<div class="container mt-3">

  <h1 class="mt-3">
    <span style="color: #002661; text-shadow: 0 0 2px rgba(0,0,0,0.6);">e</span>
    <span style="color: #007F3D; text-shadow: 0 0 2px rgba(0,0,0,0.6);;">PAD</span></h1>
  
<div class="container p-3 my-3 bg-white text-dark" style="padding : 25px">
  <h2 id="hi"style="text-align: center; padding : 25px;"></h2>

  
  <div style="text-align: justify; padding : 5px 30px;

  ">
  <h3>Informações</h3>

<div id="voltar"></div>

<h4>Gerar arquivo PDF dos PADs do colegiado</h4>
<h5><?=$nomeCurso?> [<?=  $ano?>]</h5>

Essa operação utiliza alguns segundos para ser processada 
<a href="../padstopdf/book.php?co=<?= $co_id?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Gerar arquivo</a>
<hr>

<?php

echo '<ol>';
foreach($itens as $i){
    echo '<li><a href="#'. $i->id .'">'. $i->titulo .'</a></li>';
}
echo '</ol><hr>';

$count = 1;
foreach($itens as $i){
    echo '<h5  id="'. $i->id .'">'. $count++ . '. '. $i->titulo .'</h5>' . VOLTAR;
    echo $i->conteudo;
}


?>

<p style="text-align: center;  padding-top : 70px;"><sup> UNESPAR<br>
   <span><span style="color: #002661;">PRO</span><span style="color: #007F3D;">GESP</span></span>   |
  <span><span style="color: #002661;">PRO</span><span style="color: #007F3D;">EC</span></span> |
  <span><span style="color: #002661;">PRO</span><span style="color: #007F3D;">GRAD</span></span><br>
  <span><span style="color: #002661;">e</span><span style="color: #007F3D;">PAD</span></span></sup>
</p>

  </div>
</div>

<script>

function exportToExcel(tab) {
    var tabela = document.getElementById(tab);
    var planilha = XLSX.utils.table_to_book(tabela, {sheet: "Sheet 1"});
    XLSX.write(planilha, {bookType: 'xlsx', bookSST: true, type: 'binary'});
    XLSX.writeFile(planilha, 'exportacao.xlsx');
}
</script>
