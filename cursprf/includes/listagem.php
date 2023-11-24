<div class="container mt-3"  style="margin-bottom: 0px;">
    <div class="row">
      <div class="col"><h3>Atribuição de professores as disciplinas</h3></div>
      <div class="col"  style="text-align:right"><a href="../curso/">voltar</a></div>
    </div>
    <form id="frmatrib" hidden>
      <input type="text" name="id_dis" id="id_dis">
      <input type="text" name="id_prof" id="id_prof">
    </form>

    <hr>

    <div class="form-group row" >
      <div class="col">
        <div>
            <?= $matriz->nome ?> - <?=  $turno ?>

          <div class="progress" style="height:7px; width:150px" >
              <div class="progress-bar" id="progressBar"></div>
          </div>
        </div>    
      </div>
      <div class="col">
        <ul class="pagination pagination-sm" style="height:7px;" hidden id="indicativo" fade>
          <li class="page-item"><a class="page-link" href="#"><small id="profDisciplina">Disciplina</small></a></li>
          <li class="page-item"><a class="page-link" href="#"><small id="profSelected">Professor</small></a></li>
        </ul>
      </div>
    </div>


    <!-- TABLE -->
    <div class="form-group table-responsive-sm" >

      <div class="row">

        <div class="col-9" style="max-height: 600px; overflow: scroll;">
          <table id="tabelaMatD" name="tabelaMatD" class="table table-bordered table-sm table-hover">
            <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
              <tr>
                <th style="display: none;">ID</th>
                <th style="vertical-align:top">Disciplina</th>
                <th >Carga horária</th>
                <th style="vertical-align:top">Série</th>
                <th style="vertical-align:top">Professor(ª)</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <div class="col" style="max-height: 600px; overflow: scroll;">
          <table id="tblProfs" name="tblProfs" class="table table-bordered table-sm table-hover">
            <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
              <tr>
                <th style="display: none;">ID</th>
                <th>Professor(ª)</th>
                <th style="display: none;">J</th>
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
var tblProfs = document.getElementById("tblProfs");
var tbodyProf = tblProfs.getElementsByTagName("tbody")[0];


function chProgressBar(pre){
  var perc = (pre*100)/total;
  progressBar.style=`width:${perc}%`;
  progressBar.innerHTML = pre +  ' / ' + total;
}


function deleteAllRows(){
    $("#tabelaMatD tbody tr").remove(); 
}

function deleteAllRowsProf(){
    $("#tblProfs tbody tr").remove(); 
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
  celId.innerHTML    = newDisc.id;
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie;
  celCh.innerHTML    = newDisc.ch;
  celProf.innerHTML  = newDisc.professor;
  if(newDisc.professor !== null){
    newLinha.classList.add("table-success");
    preenchido++;
  }
  chProgressBar(preenchido);
  celId.style.display = 'none';
  celProf.setAttribute("id", newDisc.id);
}

function insereTableProf(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tblProfs").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
    let celId    = newLinha.insertCell(0);
    let celNomeEColegiado  = newLinha.insertCell(1);
    let nome    = newLinha.insertCell(2);
    
    
  celId.innerHTML    = newDisc.id;
  celNomeEColegiado.innerHTML  = newDisc.nome + '<br><sup>' + newDisc.colegiado+ '</sup>';
  nome.innerHTML    = newDisc.nome;
  
  celId.style.display = 'none';
  nome.style.display = 'none';

}


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


async function getDBMDprof(ano) {
  deleteAllRowsProf();
  professores = await fetch(`../api/profvinculados.php?y=${ano}`).then(resp => resp.json()).catch(error => false);
  if (professores.length > 0){
    professores.forEach(e => insereTableProf(e));
   // noData = false;
  } /*else {
     noDataInfo();
    noData = true;
  } */
}



function verifica(){
  const l1 = id_dis.value.length;
  const l2 = id_prof.value.length;
  if((l1 > 0) && (l2 > 0)){
    atualizar();
    return true;
  } else return false;
}

//Click na tabela PROFESSORES
tbodyProf.onclick = function (e) {
    indicativo.hidden = false;
    e = e || window.event;
    var data = [];
    var target = e.srcElement || e.target;
    while (target && target.nodeName !== "TR") {
        target = target.parentNode;
    }
    if (target) {
        var cells = target.getElementsByTagName("td");
        id_prof.value = cells[0].innerHTML;
        data.push(cells[2].innerHTML);
        profSelected.innerHTML = data;
    }
    
    if(verifica()){
      var cedulaNomeProfInDisc = document.getElementById(id_dis.value);
      cedulaNomeProfInDisc.innerHTML = cells[2].innerHTML;
      id_dis.value   = '';
      id_prof.value = '';
      var trDaCedula  = cedulaNomeProfInDisc.parentNode;
      trDaCedula.classList.add("table-success");

      //ADD função para esmaecer indicativo.hidden = false;
    }
};

//Click na tabela DISCIPLINAS
tbodyMatD.onclick = function (e) {
    indicativo.hidden = false;
    e = e || window.event;
    var data = [];
    var target = e.srcElement || e.target;
    while (target && target.nodeName !== "TR") {
        target = target.parentNode;
    }
    if (target) {
        var cells = target.getElementsByTagName("td");
        id_dis.value = cells[0].innerHTML;
        data.push(cells[1].innerHTML);
        profDisciplina.innerHTML = data;
    }
    if(verifica()){
      cells[4].innerHTML = profSelected.innerHTML;  
      target.classList.add("table-success");
      id_dis.value   = '';
      id_prof.value = '';

      //ADD função para esmaecer indicativo.hidden = false;
    }  
};


//REMOVE Vinculo
tbodyMatD.ondblclick = function(e) {
  e = e || window.event;
    var data = [];
    var target = e.srcElement || e.target;
    while (target && target.nodeName !== "TR") {
        target = target.parentNode;
    }
    if (target) {
      const l1 = id_dis.value.length;
      const l2 = id_prof.value.length;
      if((l1 > 0) && (l2 == 0)){
        target.classList.remove("table-success");
        var cells = target.getElementsByTagName("td");
        cells[4].innerHTML = '';
        atualizar();
      }
    }
}

function atualizar(){
    const formAttrib = document.getElementById('frmatrib');
    const formData = new FormData(formAttrib);
    const data = Object.fromEntries(formData);

    fetch('./dml/attrib.php', {
        method:'PUT',
        headers:{
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then( res => res.json())
    .then( res => {
           var x = res.data.preenchido;
          // console.log(res.data.preenchido);
           chProgressBar(x);
        }
    );
    
    
}

getDBMDprof(2024);
</script>

<?= $script ?>