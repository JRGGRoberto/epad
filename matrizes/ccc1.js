const pegarCA = async() => {
  const data = await fetch(`../api/ca.php`)
    .then(resp => resp.json()).catch(error => false)

  if(!data) return;

  ce.innerHTML = ``;

  inserirCA(data);
}

const inserirCA = (data) => {

  ca.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ca.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });

  ca.addEventListener("change", e => {
    co.innerHTML = '';
    pegarCE(ca.value)
  });
  
}

const pegarCE = async (id) => {

  const data = await fetch(`../api/ce.php?ca=${id}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;

   inserirCE(data);

}


const inserirCE = (data) => {

  ce.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   ce.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });
  ce.addEventListener("change", e => pegarCO(ce.value))
}

const pegarCO = async (id) => {

  const data = await fetch(`../api/co.php?ce=${id}`)
     .then(resp => resp.json()).catch(error => false)

   if(!data) return;

   inserirCO(data);
}


const inserirCO = (data) => {

  co.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
   co.innerHTML += `<option value="${e["id"]}">${e["nome"]}</option>`
  });
}


matrizDisc = [];

function post_MD() {
  document.frmMatriz.submit();
}

function noDataInfo(){
  tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  newLinha = tabela.insertRow();
  newCel = newLinha.insertCell();
  newCel.textContent = "Dados não atribuidos";
  newCel.colSpan = 5;
  newCel.style.textAlign = "center";
  exit;
}

function deleteAllRows() {
  $("#tabelaMatD tbody tr").remove();
}

function carregarDados() {
  deleteAllRows();
  getDBMD();
}

function insereTable(newData) {
// Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  
  let novaLinha = tabela.insertRow();
  let celId = novaLinha.insertCell(0);
  let celAno = novaLinha.insertCell(1);
  let celCurso = novaLinha.insertCell(2);
  let celNome = novaLinha.insertCell(3);
  let celTurno = novaLinha.insertCell(4);
  let celCh = novaLinha.insertCell(5);
  let celDelete = novaLinha.insertCell(6);
  
  celId.innerHTML = newData.id;
  
  celId.style.display = 'none';
  celCh.style.textAlign = 'right';

  celAno.innerHTML = newData.ano;
  celCurso.innerHTML = newData.curso;
  celNome.innerHTML = newData.nome;
  
  let turno;
  switch (newData.turno) {
    case 'm':
      turno = 'Matutino';
      break;
    case 'v':
      turno = 'Vespertino';
      break;
    case 'n':
      turno = 'Noturno';
      break;
    case 'i':
      turno = 'Integral';
      break;
    default:
      turno = 'Não definido';
  };
  
  celTurno.innerHTML = turno;
  celCh.innerHTML = newData.ch;
  celDelete.innerHTML = `<center><button type="button" class="btn btn-light btn-sm" onclick="formEditarDados('${newData.id}')" data-toggle="tooltip" data-placement="bottom" title="Editar">✏️</button> <button type="button" class="btn btn-light btn-sm" onclick="configDisc('${newData.id}')" data-toggle="tooltip" data-placement="right" title="Configurar">⚙️</button></center>`;
}

async function getDBMD() {
  let ano = document.getElementById('anoLetivo').value;
  let id = document.getElementById('co').value;
  let a = id + ano;
  matrizDisc = await fetch(`../api/matriz.php?md=${a}`).then(resp => resp.json()).catch(error => false);
  if (matrizDisc.length > 0){
    matrizDisc.forEach(e => insereTable(e));
    
  } else {
    noDataInfo();
  }
}

function desabilitar() {
  document.getElementById('btnListarAnosL').disabled = true;
  document.getElementById('btnAdicionarAnosL').disabled = true;
  document.getElementById('anoLetivo').value = '';
  document.getElementById('anoLetivo').disabled = true;
}

function ativaEdtAno() {
  var anoLetivoEdt = document.getElementById('anoLetivo');
  anoLetivoEdt.value = '2024';
  let btnListarAnosL = document.getElementById('btnListarAnosL');
  let btnAdicionarAnosL = document.getElementById('btnAdicionarAnosL');
  btnListarAnosL.disabled = false;
  btnAdicionarAnosL.disabled = false;
  carregarDados();


  /*

  let btnListarAnosL = document.getElementById('btnListarAnosL');
  let btnAdicionarAnosL = document.getElementById('btnAdicionarAnosL');
  if (!anoLetivo.value) {
    anoLetivoEdt.disabled = false;
  } else {
    desabilitar();
  }

  btnListarAnosL.disabled = false;
  btnAdicionarAnosL.disabled = false;
  */
}
/*
function ativaBTNsLA() {
  let btnListarAnosL = document.getElementById('btnListarAnosL');
  let btnAdicionarAnosL = document.getElementById('btnAdicionarAnosL');
  var anoLetivoEdt = document.getElementById('anoLetivo');
  anoLetivoEdt.value = 2024;
  if (anoLetivoEdt.length = 4) {
    btnListarAnosL.disabled = false;
    btnAdicionarAnosL.disabled = false;
  } else {
    btnListarAnosL.disabled = true;
    btnAdicionarAnosL.disabled = true;
  }
}
ativaEdtAno();
btnListarAnosL.disabled = false;
    btnAdicionarAnosL.disabled = false;
*/

function fecharModalDis() {
  clearModal();
  $('#modalDis').modal('hide');
}

function preencheForm(id){
  let index = matrizDisc.findIndex(e => e.id === id);
  let myObj = matrizDisc[index];
  document.getElementById("id_md").value = id;
  // Preenche os inputs
  document.getElementById("anoLet").value = myObj.ano;
  document.getElementById("categ").value = myObj.categ;
  document.getElementById("nomeCurso").value = myObj.curso;
  document.getElementById("chTotal").value = myObj.ch;
  document.getElementById("nome").value = myObj.nome;
  document.getElementById("habilitacao").value = myObj.habilitacao;
  document.getElementById("oferta").value = myObj.oferta;
  document.getElementById("vagas").value = myObj.vagas;
  document.getElementById("periodo").value = myObj.turno;
  document.getElementById("to_do").value = 'upd';

  let nomeCurso = document.getElementById('nomeCurso');
  let selCam = document.getElementById('ca');
  let selCen = document.getElementById('ce');
  let selCur = document.getElementById('co');
  nomeCurso.value = selCur.options[selCur.selectedIndex].text;
  
  let id_camp_form = document.getElementById("id_camp_form");
  let id_cent_form = document.getElementById("id_cent_form");
  let id_curs_form = document.getElementById('id_curs_form');
  
  id_camp_form.value = selCam.value;
  id_cent_form.value = selCen.value;
  id_curs_form.value = selCur.value;
}

function configDisc(id){
  preencheForm(id);
  document.getElementById("to_do").value = 'conf';
  document.frmMatriz.submit();
}

function formEditarDados(id) {

  document.getElementById("titleMemb").innerHTML = 'Editar dados da Matriz de Disciplinas';
  document.getElementById("addMatrDis").hidden = true;
  document.getElementsByName("altMemb")[0].hidden = false;
  
  preencheForm(id);
  
  $('#modalDis').modal('show');
};

function formAddMatDis() {
  clearModal();
  document.getElementById("titleMemb").innerHTML = 'Adicionar Matriz de Disciplinas';
  let anoLet = document.getElementById('anoLet');
  anoLet.value = document.getElementById('anoLetivo').value;
  
  document.getElementById("to_do").value = 'add';
  
  let nomeCurso = document.getElementById('nomeCurso');
  let selCam = document.getElementById('ca');
  let selCen = document.getElementById('ce');
  let selCur = document.getElementById('co');
  nomeCurso.value = selCur.options[selCur.selectedIndex].text;
  
  let id_camp_form = document.getElementById("id_camp_form");
  let id_cent_form = document.getElementById("id_cent_form");
  let id_curs_form = document.getElementById('id_curs_form');
  
  id_camp_form.value = selCam.value;
  id_cent_form.value = selCen.value;
  id_curs_form.value = selCur.value;
  
  $('#modalDis').modal('show');
  document.getElementById("addMatrDis").hidden = false;
  document.getElementsByName("altMemb")[0].hidden = true;
}

function clearModal() {
  document.getElementById("id_md").value = '';
  document.getElementById("to_do").value = '';
  document.getElementById("categ").value = '';
  document.getElementById("chTotal").value = "";
  document.getElementById("habilitacao").selectedIndex = 0;
  document.getElementById("oferta").selectedIndex = 0;
  document.getElementById("periodo").selectedIndex = 0;
  document.getElementById("vagas").value = "";
  document.getElementById("id_camp_form").value = '';
  document.getElementById("id_cent_form").value = '';
  document.getElementById("id_cent_form").value = '';
  document.getElementById('chTotal').focus();
}


window.onload = function() {
  desabilitar();
};

function preenche(ca, ce, co, ano) {
  pegarCA().then(
    (onResolved) => {
      selectOpt("ca",  ca  )
    }
  ).then(
    (onResolved) => {
      pegarCE(ca).then(
        (onResolved) => {
          selectOpt("ce",  ce  )
        }
      )
    }
  ).then(
    (onResolved) => {
      pegarCO( ce  ).then(
        (onResolved) => {
          selectOpt("co",  co  )
        }
      )
    }
  ).then(
    (onResolved) => {
      document.getElementById('anoLetivo').disabled = false;
      document.getElementById('anoLetivo').value = ano;
      document.getElementById('btnListarAnosL').disabled = false;  
      document.getElementById('btnAdicionarAnosL').disabled = false;  
    }
  ).then((onResolved) => {
      setTimeout(function() {
         carregarDados();
      }, 700);
    }
  )
}





