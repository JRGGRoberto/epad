<div class="container mt-3"  style="margin-bottom: 0px;">
    <div class="row">
      <div class="col-11"><h3>Distribuição de professores por disciplinas - PAD <?= $matriz->ano ?></h3></div>
      <div class="col"  style="text-align:right"><!--<a href="../curso/">voltar</a> --> <a class="card-link" href="../ajuda/?help=coord_aulas" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a></div>
    </div>
    <form id="frmatrib" hidden>
      <input type="text" name="id_dis" id="id_dis">
      <input type="text" name="id_prof" id="id_prof">
    </form>

    <hr>

    <div class="form-group row" >
      <div class="col-5">
        <div>
            <?= $matriz->nome ?> - <?=  $turno ?>

          <div class="progress" style="height:10px; width:180px" >
              <div class="progress-bar anim" id="progressBar"></div>
          </div>
        </div>    
      </div>
      <div class="col-1"></div>
      <div class="col d-flex justify-content-center">
        <ul class="pagination pagination-sm" style="height:7px;" hidden id="indicativo" fade>
          <li class="page-item"><a class="page-link" href="#"><small id="profDisciplina"><span class="spinner-border text-primary spinner-border-sm"></span> Selecione uma disciplina</small></a></li>
          <li class="page-item"><a class="page-link" href="#"><small id="profSelected"><span class="spinner-border text-primary spinner-border-sm"></span> Selecione um professor</small></a></li>
        </ul>
      </div>
    </div>


    <!-- TABLE -->
    <div class="form-group table-responsive-sm" >

      <div class="row">

        <div class="col" style="max-height: 600px; overflow: scroll;">
          
          <table id="tabelaMatD" name="tabelaMatD" class="table table-bordered table-sm table-hover">
            <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
              <tr>
                <th colspan="4"><input class="form-control" id="impBuscarDis" type="text" placeholder="Buscar disciplina"></th>
              </tr>

              <tr>
                <th style="display: none;">ID</th>
                <th style="vertical-align:top">Disciplina</th>
                <th  style="vertical-align:top; width: 75px; text-align: center;">Carga horária</th>
                <th style="vertical-align:top; text-align: center;">Série</th>
                <th style="vertical-align:top; width: 200px;">Professor(ª)<span id="infoRemove" hidden class="badge badge-secondary" id="DoubleClick">DoubleClick to remove</span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>
    </div>
</div>

<script>

let disciplinas = [];
let professores = [];
let noData = true;
let total = 0;
let preenchido = 0;
let indicativo = document.getElementById("indicativo");



const progressBar = document.getElementById("progressBar");
var profDisciplina = document.getElementById("profDisciplina")
var tabelaMatD = document.getElementById("tabelaMatD");
var tbodyMatD = tabelaMatD.getElementsByTagName("tbody")[0];
var id_dis = document.getElementById("id_dis");
var id_prof = document.getElementById("id_prof");
var profSelected = document.getElementById("profSelected")

var infoRemove = document.getElementById("infoRemove");


function chProgressBar(pre){
  var perc = (pre*100)/total;
  progressBar.style=`width:${perc}%`;
  progressBar.innerHTML = pre +  ' / ' + total;
}


function deleteAllRows(){
    $("#tabelaMatD tbody tr").remove(); 
}


function removeLinhaSemDados(){
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  tabela.deleteRow(0);
}

function noDataInfo(){
  tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  newLinha = tabela.insertRow();
  newCel = newLinha.insertCell();
  newCel.textContent = "Dados não atribuidos";
  newCel.colSpan = 5;
  newCel.style.textAlign = "center";
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
    let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
    let newLinha = tabela.insertRow();
    let celId    = newLinha.insertCell(0);
    let celDisc  = newLinha.insertCell(1);
    let celCh    = newLinha.insertCell(2);
    let celSerie = newLinha.insertCell(3);
    let celProf  = newLinha.insertCell(4);
    let ceDispo  = newLinha.insertCell(5);
  celId.innerHTML    = newDisc.id;
  celId.style.display = 'none';
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie + 'º';
  celCh.innerHTML    = newDisc.ch;
  ceDispo.innerHTML  = newDisc.disponivel;
  ceDispo.style.display = 'none';
  
  let info = '';
  if(newDisc.professor !== null){

    if(newDisc.disponivel == 0 ){
       info = ' 🔒';
    }
    newLinha.classList.add("table-success");
    preenchido++;
    celProf.innerHTML  = newDisc.professor + info;
  } else {
    celProf.innerHTML  = newDisc.professor;
  }
  
  
  chProgressBar(preenchido);
  
  celProf.setAttribute("id", newDisc.id);
  celSerie.style.textAlign = 'center';
  celCh.style.textAlign = 'right';
}

$(document).ready(function(){
  $("#impBuscarDis").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabelaMatD tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

async function getDBMD(id) {
  deleteAllRows();
  disciplinas = await fetch(`../api/discip.php?mat=${id}`).then(resp => resp.json()).catch(error => false);
  total = disciplinas.length;
  if (disciplinas.length > 0){
    disciplinas.forEach(e => insereTable(e));
    noData = false;
  } else {
    noDataInfo();
    noData = true;
  }
}




</script>

<?= $script ?>
<style>
.anim {
  animation: crescer 2.5s;

}

@keyframes crescer {
  0%{
    width: 0
  }
}
</style>