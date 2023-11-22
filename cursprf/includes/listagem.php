<div class="container mt-3">
    <h3>Atribuição de professores as disciplinas</h3>
    <form id="frmatrib">
      <input type="text" name="id_dis" id="id_dis">
      <input type="text" name="id_prof" id="id_prof">
      <input type="submit" value="enviar">
    </form>

    <hr>

    <div class="form-group row" >
      <div class="col"><?= $matriz->nome ?> - <?=  $turno ?></div>
      <div class="col">
        <ul class="pagination pagination-sm">
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
                <th>Disciplina</th>
                <th>Carga horária</th>
                <th>Série</th>
                <th>Professor(ª)</th>
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

            <tr><td hidden>0fd0dfa2-3dcd-11ed-9793-0266ad9885af</td><td>Miguel Faria<br><sup>Administração - Bacharelado</sup></td><td hidden>Miguel Faria</td></tr>
<tr><td hidden>1bdade92-625c-4551-9d14-281465d6c551</td><td>Pedro Gomes<br><sup>Administração - Bacharelado</sup></td><td hidden>Pedro Gomes</td></tr>
<tr><td hidden>b0c22cec-3e6a-11ed-9793-0266ad9885af</td><td>Ana Paula Guimarães<br><sup>Ciências Contábeis - Bacharelado</sup></td><td hidden>Ana Paula Guimarães</td></tr>
<tr><td hidden>74183e1a-4577-11ed-9793-0266ad9885af</td><td>Cleber Broietti<br><sup>Ciências Contábeis - Bacharelado</sup></td><td hidden>Cleber Broietti</td></tr>
<tr><td hidden>b8fa555f-cedb-47cf-91cc-7581736aac88</td><td>José Roberto de Góes Gomes<br><sup>Ciências da Computação - Bacharelado</sup></td><td hidden>José Roberto de Góes Gomes</td></tr>
<tr><td hidden>56e08dde-099c-4d4c-aa2c-0161b2d6ff3f</td><td>Tânia Terezinha Rissa<br><sup>Ciências Econômicas - Bacharelado</sup></td><td hidden>Tânia Terezinha Rissa</td></tr>
<tr><td hidden>3442d0c9-464d-11ed-9793-0266ad9885af</td><td>Ana Claudia Freitas Pantoja<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Ana Claudia Freitas Pantoja</td></tr>
<tr><td hidden>4ee313a3-464c-11ed-9793-0266ad9885af</td><td>Ana Paula F. de Mendonça<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Ana Paula F. de Mendonça</td></tr>
<tr><td hidden>7da40637-464c-11ed-9793-0266ad9885af</td><td>Ana Paula Peron<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Ana Paula Peron</td></tr>
<tr><td hidden>9c72f724-456b-11ed-9793-0266ad9885af</td><td>Joelma Castelo Bernardo da Silva<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Joelma Castelo Bernardo da Silva</td></tr>
<tr><td hidden>d1aab181-464b-11ed-9793-0266ad9885af</td><td>Neluana Leuz de Oliveira Ferragini<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Neluana Leuz de Oliveira Ferragini</td></tr>
<tr><td hidden>c30d4d76-464c-11ed-9793-0266ad9885af</td><td>Patrícia Josiane Tavares da Cunha<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Patrícia Josiane Tavares da Cunha</td></tr>
<tr><td hidden>f4f938ad-464c-11ed-9793-0266ad9885af</td><td>Renan Luis Salermo<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Renan Luis Salermo</td></tr>
<tr><td hidden>087d6efe-464c-11ed-9793-0266ad9885af</td><td>Rosimeiri Darc Cardoso<br><sup>Letras Português - Licenciatura</sup></td><td hidden>Rosimeiri Darc Cardoso</td></tr>
<tr><td hidden>0bd7d27b-a14a-4c4d-a4d0-72d33f3e7e20</td><td>José Ricardo dos Santos<br><sup>Matemática - Licenciatura</sup></td><td hidden>José Ricardo dos Santos</td></tr>
<tr><td hidden>2848a762-36ae-42e8-a0ea-b6f2ec79cab2</td><td>Juliano de Andrade<br><sup>Matemática - Licenciatura</sup></td><td hidden>Juliano de Andrade</td></tr>
<tr><td hidden>c771f75a-7427-4d7c-8ff1-388e8e59ff9d</td><td>Merline Cristina Faustino<br><sup>Matemática - Licenciatura</sup></td><td hidden>Merline Cristina Faustino</td></tr>
<tr><td hidden>83690c70-2689-4e6c-83a3-ca4987ccc4f5</td><td>Sérgio Dantas<br><sup>Matemática - Licenciatura</sup></td><td hidden>Sérgio Dantas</td></tr>
<tr><td hidden>f6e0e41d-b03d-4d73-b69d-6d202883c5dd</td><td>Carla Caroline Holm<br><sup>Geografia - Licenciatura</sup></td><td hidden>Carla Caroline Holm</td></tr>
<tr><td hidden>91478375-b3d1-49b3-a9da-4d077890c652</td><td>Alcimara Foetsch<br><sup>Filosofia - Licenciatura</sup></td><td hidden>Alcimara Foetsch</td></tr>
<tr><td hidden>f60e6d21-0976-4017-af45-4a3ee146fcad</td><td>Camila Juraszeck Machado<br><sup>Filosofia - Licenciatura</sup></td><td hidden>Camila Juraszeck Machado</td></tr>
<tr><td hidden>75ae3490-35c4-42e0-9f2f-ef32b62e4d1c</td><td>Everton Carlos Crema<br><sup>História - Licenciatura </sup></td><td hidden>Everton Carlos Crema</td></tr>

            </tbody>
          </table>
            

        </div>

      </div>
    </div>
</div>

<script>

let disciplinas = [];
let noData = true;


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

function frmExcluirShow(id){
  $('#modalDel').modal('show');
  alert(id);
  /*
  let nomeDisDel = document.getElementById('nomeDisDel');
  let id_disDel = document.getElementById('id_disDel');
  let index = disciplinas.findIndex(e => e.id === id);
  let myObj = disciplinas[index];
  nomeDisDel.innerHTML =  myObj.nome;
  id_disDel.value = myObj.id;
  */
}


function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
    let celId    = newLinha.insertCell(0);
    let celDisc  = newLinha.insertCell(1);
    let celCh    = newLinha.insertCell(2);
    let celSerie = newLinha.insertCell(3);
    let celProf = newLinha.insertCell(4);
  celId.innerHTML    = newDisc.id;
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie;
  celCh.innerHTML    = newDisc.ch;
  celProf.innerHTML  = '';
  celId.style.display = 'none';
  celProf.setAttribute("id", newDisc.id);
}

function updateDisciplina(receiveData){
  data = receiveData.data;
  disciplinas[data.idx] = {
    nome: data.nome,
    ch: data.ch,
    serie: data.serie,
    id: data.id
  };
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];
  linha.cells[1].innerHTML = data.nome;
  linha.cells[2].innerHTML = data.ch;
  linha.cells[3].innerHTML = data.serie;
}

function addDisciplina(receiveData) {
  data = receiveData.data;
  disciplinas.push(data);

  noData ? removeLinhaSemDados(): null;
  insereTable(data);
}


/*
formM.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(formM);
    const data = Object.fromEntries(formData);


    // Se tiver ID é uma edição se não ADD
    const id = document.getElementById('id').value;
    if(id === '') {
      fetch('./dml/insert.php', {
          method:'POST',
          headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then( data => addDisciplina(data));
      fecharModalDis();
    } else {
      fetch('./dml/update.php', {
          method:'PUT',
          headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
      })
      .then( res => res.json())
      .then( data => updateDisciplina(data));
      fecharModalDis();
    }
});
*/


async function getDBMD(id) {
  deleteAllRows();
  disciplinas = await fetch(`../api/discip.php?mat=${id}`).then(resp => resp.json()).catch(error => false);
  
  if (disciplinas.length > 0){
    disciplinas.forEach(e => insereTable(e));
    noData = false;
  } else {
    noDataInfo();
    noData = true;
  }

}

var profDisciplina = document.getElementById("profDisciplina")
var tabelaMatD = document.getElementById("tabelaMatD");
var tbodyMatD = tabelaMatD.getElementsByTagName("tbody")[0];
var id_dis = document.getElementById("id_dis");
var id_prof = document.getElementById("id_prof");
var profSelected = document.getElementById("profSelected")
var tblProfs = document.getElementById("tblProfs");
var tbodyProf = tblProfs.getElementsByTagName("tbody")[0];

tbodyProf.onclick = function (e) {
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
    }
    profSelected.innerHTML = data;
    if(id_dis.value !== ''){
      document.getElementById(id_dis.value).innerHTML = cells[2].innerHTML;
    }
};

tbodyMatD.onclick = function (e) {
    e = e || window.event;
    var data = [];
    var target = e.srcElement || e.target;
    while (target && target.nodeName !== "TR") {
        target = target.parentNode;
    }
    if (target) {
        var cells = target.getElementsByTagName("td");
        data.push(cells[1].innerHTML);
    }
    profDisciplina.innerHTML = data;
    
    if(profSelected.innerHTML !== 'Professor'){
      id_dis.value = cells[0].innerHTML;
      cells[4].innerHTML = profSelected.innerHTML;  
      target.classList.add("table-success");
    } 

    
};

const formAttrib = document.getElementById('frmatrib');
formAttrib.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(formAttrib);
    const data = Object.fromEntries(formData);

    fetch('./dml/attrib.php', {
        method:'PUT',
        headers:{
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
});



</script>

<?= $script ?>