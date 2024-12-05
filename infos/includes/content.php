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

<h5>Gerar arquivo PDF dos PAD do colegiado</h5>
Essa operação utiliza alguns segundos para ser processada 
<a href="../padstopdf/book.php?co=<?= $co_id?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Gerar arquivo</a>
<hr>



<ol>
    <li><a href="#id1">Quadro de professores atual do meu colegiado</a></li> 

    <li><a href="#id2">Distribuição de RT no colegiado de <?=$col_nome ?> </a></li>

    <li><a href="#id3">Matriz(es) do curso <?=$col_nome?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li>

    <!-- <li><a href="#id4">Matriz(es)/Disciplinas do curso <?=$col_nome ?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li> -->

        <!-- <li><a href="#id55">Professores CRES <?=$col_nome?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li> -->

    <li><a href="#id5">Professores distribuidos por disciplinas <?=$col_nome?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li>

    <li><a href="#id6">Quadro de professores do colegiado <?=$col_nome?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li>

    <li><a href="#id7">Atividades de Supervisão e Orientação dos Professores do colegiado <?=$col_nome?> - <?=$camp_nome?>/<?=$centro_nome?> </a></li>

    <li><a href="#id8">Resumo por curso - Colegiado de <?=$col_nome?> em <?=$camp_nome?> </a></li>

    <li><a href="#id9"> Disciplinas do colegiado de <?=$col_nome?> </a></li>

    <li><a href="#id10"> Atividades de Gestão Institucional </a></li>

    <li><a href="#id11"> Disciplinas sem professores </a></li>
    
    <li><a href="#id12"> Projetos de ensino e monitoria </a></li>

</ol>

<?= $tbl_contrads ?>

<?= $tbl_rt ?>

<?= $tbl_matriz ?>

<?= $tbl_disc ?>

<?= $tbl_cres ?>

<?= $tbl_disc1 ?>

<?= $tbl_prof ?>

<?= $tbl_pad22 ?>

<?= $tbl_resumo ?>

<?= $tbl_profes ?>

<?= $tbl_atvgest ?>

<?= $tbl_dispnoprof ?>

<?= $tbl_projmonit ?>


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
