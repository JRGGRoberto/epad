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
  //let celCh = novaLinha.insertCell(5);
  let clPreenc = novaLinha.insertCell(5);
  let celDelete = novaLinha.insertCell(6);
  
  celId.innerHTML = newData.id;
  
  celId.style.display = 'none';
  clPreenc.style.textAlign = 'center';
  //celCh.style.textAlign = 'right';

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
  //celCh.innerHTML = newData.ch;
  
  if (newData.qnt_dis == 0) {
    clPreenc.innerHTML = 'Sem disciplinas';
    celDelete.innerHTML = '<center>◽</center>';

  } else {
    clPreenc.innerHTML = newData.qnt_pre + '/' + newData.qnt_dis;
    celDelete.innerHTML = `<center><button type="button" class="btn btn-light btn-sm" onclick="configDisc('${newData.id}')" data-toggle="tooltip" data-placement="right" title="Configurar">⚙️</button></center>`;
  }

  if(newData.qnt_dis > 0){
    if (newData.qnt_pre == newData.qnt_dis){
      novaLinha.classList.add("table-success");
    }
  } 
}

async function getDBMD(id) {
  /*arrDados =  id.split("@");
  id = arrDados[0];
  ano = arrDados[1]; 
  let a = id + ano;*/
  let a = id;
  matrizDisc = await fetch(`../api/matriz.php?md=${a}`).then(resp => resp.json()).catch(error => false);
  if (matrizDisc.length > 0){
    matrizDisc.forEach(e => insereTable(e));
    
  } else {
    noDataInfo();
  }
}

function configDisc(id){
  window.location = `../cursprf/index.php?id=${id}`;
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
