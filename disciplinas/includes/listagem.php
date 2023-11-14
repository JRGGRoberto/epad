<div class="container mt-3">
    <h1>Matriz de Disciplinas</h1>

    <hr>

    <div class="row">
      <div class="col-2">
        <div class="form-group">
          <label for="ca">Campus</label>
          <select name="id_campus" id="ca" class="form-control" readonly>
            <option value=""><?= $inf->campus ?></option>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="ce">Centro</label>
          <select name="id_centro" id="ce" class="form-control" readonly>
            <option value=""><?= $inf->centros ?></option>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="co">Curso</label>
          <select name="id_colegiado" id="co" class="form-control" readonly>
            <option value=""><?= $inf->colegiado ?></option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      Nome: <?= $matriz->nome ?>
    </div>


    <div class="form-group">  
                  <div class="row">
                    <div class="form-group col-2">
                      Ano letivo: <?= $matriz->ano ?>
                    </div>

                    <div class="form-group col-2">
                      Vagas: <?= $matriz->vagas ?>
                    </div>

                    <div class="form-group col">
                      Carga horária informada: <span id="chInfo"><?= $matriz->ch ?></span>
                    </div>

                    <div class="form-group col">
                      Carga horária atribuída: <span id="chAtt">0</span>
                    </div>
                    
                    <div class="form-group col">
                      <span id="chResult"></span>
                    </div>

                    
                    
                  </div>
    
                  <div class="row">
                    <div class="form-group col">
                      Habilitação: <?= $habil ?>
                    </div>

                    <div class="form-group col-5">
                      Regime de oferta: <?= $oferta ?>
                    </div>

                    <div class="form-group col">
                      Período de funcionamento: <?= $turno ?>
                    </div>

                  </div>
              </div>

    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <table id="tabelaMatD" name="tabelaMatD" class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="display: none;">ID</th>
            <th>Disciplina</th>
            <th>Carga horária</th>
            <th>Série</th>
            <th style="text-align: center; width:130px" >
            <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" id="btnAdicionarD">➕</button>
                </div>
                <div class="col">
                    <div class="dropdown">
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    📥 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#">
                         <form method="post" action="./import.php">
                            <textarea name="import_json" name="import_json" cols="30" rows="10"></textarea>
                            <input type="submit" value="⚡" id="importacao_json">
                            <input type="hidden" name="id_master" id="id_master" value="<?= $matriz->id ?>">
                            <input type="hidden" name="url_corrente" id="url_corrente" value="<?=$_SERVER["REQUEST_URI"]?>">
                         </form>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>

    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalDis">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMemb">TITULO</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDisc" name="frmDisc" method="post">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="disc">Nome da disciplina</label>
                    <input type="text" class="form-control" id="disc" name="disc" >
                    <input type="hidden" name="id_matriz" id="id_matriz" value="<?= $matriz->id ?>">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idx" id ="idx">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="ch">Carga horária</label>
                    <input type="text" class="form-control" id="ch" name="ch" >
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="serie">Série</label>
                    <input type="text" class="form-control" id="serie" name="serie" >
                  </div>
                </div>
              </div>
              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDis()">Fechar</button>
                <button type="submit" id="addMatrDis" class="btn btn-primary btn-sm" ></button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->






    <!-- The Modal DELET-->
    <div class="modal fade" id="modalDel">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" >Remover disciplina</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDiscDel" name="frmDiscDel" method="post">
              <div class="form-group">
                Tem certeza que deseja apagar a disciplina abaixo? 
                <div class="d-flex justify-content-center mb-3" id="nomeDisDel"></div>
                <input type="hidden" name="id_disDel" id="id_disDel">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm" >Apagar</button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->


<script>

let disciplinas = [ ];
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

const frmDEL = document.getElementById('frmDiscDel');
frmDEL.addEventListener('submit', e => {
  e.preventDefault();
  let id = document.getElementById('id_disDel').value;
  fetch(`./dml/delete.php?id=${id}` , {
      method: 'DELETE',
      headers: {
          'Content-Type': 'application/json'
          // Se você precisa de algum token de autenticação, adicione aqui
    }
  })
  .then(res => {
      if (!res.ok) {
          throw new Error('Erro ao excluir o recurso.');
      }
      return res.json(); 
  })
  .then(data => excluirLinhaTbl(data) )
  .catch(error => {
      console.error(error);
  });
  fecharModalDel();
});


function excluirLinhaTbl(idr) {
  console.log(`Mensagem: ${idr.message}`);
  console.log(`ID: ${idr.id}`);
  let idx = disciplinas.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    disciplinas.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
  dadosCH();
}

function fecharModalDel(){
  $('#modalDel').modal('hide');
}

function fecharModalDis() {
  $('#modalDis').modal('hide');
}

function formEditar(id) {
  let idx = disciplinas.findIndex(d =>d.id === id);
  let myObj = disciplinas[idx];
  document.getElementById("idx").value = idx;
  document.getElementById("id").value = myObj.id;
  document.getElementById("disc").value = myObj.nome;
  document.getElementById("ch").value = myObj.ch;
  document.getElementById("serie").value = myObj.serie;
  document.getElementById("titleMemb").innerHTML = 'Editar disciplina';
  $('#modalDis').modal('show');
  document.getElementById("addMatrDis").innerHTML = "Alterar";
}

// Show modal ADD diciplina
function formAddDis() {
  clearModal();
  document.getElementById("titleMemb").innerHTML = 'Adicionar disciplina';
  $('#modalDis').modal('show');
  document.getElementById("addMatrDis").innerHTML = "Adicionar";
}

function clearModal() {
  document.getElementById("id").value = '';
  document.getElementById("idx").value = '';
  document.getElementById("disc").value = '';
  document.getElementById("ch").value = '';
  document.getElementById("serie").value = '';
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
    let celId    = newLinha.insertCell(0);
    let celDisc  = newLinha.insertCell(1);
    let celCh    = newLinha.insertCell(2);
    let celSerie = newLinha.insertCell(3);
    let celDelet = newLinha.insertCell(4);
  celId.innerHTML    = newDisc.id;
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie;
  celCh.innerHTML    = newDisc.ch;
  celDelet.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none';
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
  dadosCH();
  noData ? removeLinhaSemDados(): null;
  insereTable(data);
}

function dadosCH(){
  let chInfo = document.getElementById('chInfo');
  let chAtt = document.getElementById('chAtt');
  let chResult = document.getElementById('chResult');
  if(disciplinas.length == 0){
    chAtt.innerHTML = '0';
    noData = true;
  } else {
    chAtt.innerHTML = disciplinas.reduce((a, b) => a + parseInt(b.ch), 0);
    noData = false;
  }

  if (parseInt(chInfo.innerHTML) > parseInt(chAtt.innerHTML)){
    chResult.innerHTML = 'Em falta';
  } else if (parseInt(chInfo.innerHTML) < parseInt(chAtt.innerHTML)) {
    chResult.innerHTML = 'Extrapolou';
  } else {
    chResult.innerHTML = 'Completo';
  }
}

const formM = document.getElementById('frmDisc');
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

async function getDBMD() {
  deleteAllRows();
  let mat = document.getElementById('id_matriz').value;
  disciplinas = await fetch(`../api/discip.php?mat=${mat}`).then(resp => resp.json()).catch(error => false);
  
  if (disciplinas.length > 0){
    disciplinas.forEach(e => insereTable(e));
    noData = false;
  } else {
    noDataInfo();
    noData = true;
  }
  dadosCH();
}

getDBMD();

</script>