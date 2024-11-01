<div class="container mt-3"  style="margin-bottom: 0px;">
    <div class="row">
      <div class="col"><h3>Matriz de Disciplinas</h3></div>
      <div class="col"  style="text-align:right"><a href="../cursoTm/">voltar</a></div>
    </div>

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
      Matriz: <?= $matriz->nome ?>
    </div>


    <div class="form-group">  
                  <div class="row">
                    <div class="form-group col-2">
                      Ano letivo: <?= $matriz->ano ?>
                    </div>


                    <div class="form-group col" hidden>
                      Carga horária informada: <span id="chInfo"><?= $matriz->ch ?></span>
                    </div>

                    <div class="form-group col" hidden>
                      Carga horária atribuída: <span id="chAtt">0</span>
                    </div>
                    
                    <div class="form-group col" hidden>
                      <span id="chResult"></span>
                    </div>

                    <div class="form-group col" >
                      Categoria: <span ><?= $matriz->catego ?></span>
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
            <th>Modal</th>
            <th style="text-align: center; width:130px">
              <button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" id="btnAdicionarD">➕</button>
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
                    <input type="hidden" name="uid" id="uid" value="<?=$user['id']?>">
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
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="tipo_vinculo">Composição</label>
                      <select name="tipo_vinculo" id="tipo_vinculo" class="form-control" value="<?=$user['tipo_vinculo']?>">
                        <option value="1">Um professor atendende está disciplina</option>
                        <option value="n">Professores dividem a disciplina [dividindo o tempo]</option>
                        <option value="m">Várias turmas [multiplica o tempo]</option>
                      </select>
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
                <div  id="msgApagar"></div>
                <div class="d-flex justify-content-center mb-3 font-weight-bold" id="nomeDisDel"></div>
                <input type="hidden" name="id_disDel" id="id_disDel">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm" id="btnApagar"  >Apagar</button>
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
  let nomeDisDel = document.getElementById('nomeDisDel');
  let id_disDel = document.getElementById('id_disDel');
  let msgApagar = document.getElementById('msgApagar');
  let index = disciplinas.findIndex(e => e.id === id);
  let myObj = disciplinas[index];
  if((myObj.vinculo == null) || (myObj.vinculo == '')){
    msgApagar.innerHTML = 'Tem certeza que deseja apagar a disciplina abaixo?';
    btnApagar.hidden = false;
  } else {
    msgApagar.innerHTML = 'Há um professor vinculado a essa disciplina, solicite ao coordenador para remove-lo, depois poderá excluir esta disciplina';
    btnApagar.hidden = true;
  }

  nomeDisDel.innerHTML =  myObj.nome;
  id_disDel.value = myObj.id;
  
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
  document.getElementById("titleMemb").innerHTML = 'Solicitação de alteração de disciplina';
  document.getElementById("tipo_vinculo").value = myObj.tipo_vinculo;
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

  document.getElementById("tipo_vinculo").value = '1';
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
    let celTp_vinculo = newLinha.insertCell(4);
    let celDelet = newLinha.insertCell(5);
    
    // mudanca 
    
   // let celDelet = newLinha.insertCell(6);
  celId.innerHTML    = newDisc.id;
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie;
  celCh.innerHTML    = newDisc.ch;
  let tp_vinc = '';
  switch(newDisc.tipo_vinculo) {
    case "1": tp_vinc = 'Um professor atendende está disciplina';
            break;
    case "n": tp_vinc = 'Professores dividem a disciplina';
            break;
    case "m": tp_vinc = 'Várias turmas';
            break;
  }
  

  celTp_vinculo.innerHTML = tp_vinc;
  celDelet.innerHTML  = 
  `<center>
   <button type="button" class="btn btn-light btn-sm" onclick="formEditar('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none';
}
// <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('${newDisc.id}')">⛔</button>

function updateDisciplina(receiveData){
  data = receiveData.data;
  disciplinas[data.idx] = {
    nome: data.nome,
    ch: data.ch,
    serie: data.serie,
    id: data.id,
    tipo_vinculo: data.tipo_vinculo,
    mudanca: data.mudanca 
  };
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];
  linha.cells[1].innerHTML = data.nome;
  linha.cells[2].innerHTML = data.ch;
  linha.cells[3].innerHTML = data.serie;
  linha.cells[4].innerHTML = data.tipo_vinculo;
  linha.cells[5].innerHTML = data.mudanca;
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