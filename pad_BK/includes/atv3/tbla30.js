let data3 = [ ];
let noData3 = true;

function deleteAllRows3(){
  $("#tbl3 tbody tr").remove(); 
}


function calculaSubt(){
  total3.innerHTML = data3.reduce((a, b) => a + parseInt(b.chs), 0);
}

function insereTable3(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId         = newLinha.insertCell(0);
    let celNome       = newLinha.insertCell(1);
    let celFunc       = newLinha.insertCell(2);
    let celNomeOrient = newLinha.insertCell(3);
    let celCH         = newLinha.insertCell(4);
    let celDelet      = newLinha.insertCell(5);
    let tipo = '';
    switch (newDisc.tp) {
      case '1':
        tipo = 'Pesquisa';
        break;
      case '2':
        tipo = 'Extensão e cultura';
        break;
      case '3':
        tipo = 'Outro - informar em observações';
        break;
      default:
        tipo = 'Não definido';
    };

    let func = '';
    switch (newDisc.func) {
      case '1':
        func = 'Coordenador';
        break;
      case '2':
        func = 'Membro';
        break;
      case '3':
        func = 'Programas especiais';
        break;
      default:
        func = 'Não definido';
    };
  
  celId.innerHTML         = newDisc.id;
  celNome.innerHTML       = tipo +': '+ newDisc.nome;
  celFunc.innerHTML       = func;
  celNomeOrient.innerHTML = newDisc.orientandos;
  celCH.innerHTML         = newDisc.chs;
  celDelet.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow3('t3${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar3('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none'; 
}

function formAddAtv3() {
  clearModal3();
  document.getElementById("titleMotal3").innerHTML = 'Adicionar atividade';
  document.getElementById("addAtv3").innerHTML = "Adicionar";
  $('#modalAtv3').modal('show');
}

function clearModal3(){
  document.getElementById('tpProj3').value = '';
  document.getElementById('nome3').value = '';
  document.getElementById('funcao3').value = '';
  document.getElementById('orientandos3').value = '';
  document.getElementById('cargah3').value = '';
}

function formEditar3(id) {
  let idx3 = data3.findIndex(d =>d.id === id);
  let myObj = data3[idx3];
  document.getElementById("idx3").value = idx3;
  document.getElementById("id3").value  = myObj.id;
  document.getElementById('tpProj3').value = myObj.tp;
  document.getElementById('nome3').value = myObj.nome;
  document.getElementById('funcao3').value =myObj.func;
  document.getElementById('orientandos3').value = myObj.orientandos;
  document.getElementById('cargah3').value = myObj.chs;

  document.getElementById("titleMotal3").innerHTML = 'Editar atividade';
  document.getElementById("addAtv3").innerHTML = "Alterar";

  $('#modalAtv3').modal('show');
}


function fecharModalAtv3() {
  clearModal3();
  $('#modalAtv3').modal('hide');
}

function tradaDados3(receiveData){
  return dados = {
    id      : receiveData.id3,
    id_vin  : receiveData.vinc3, 		
    tp	    : receiveData.tpProj3,
    nome	  : receiveData.nome3,
    func	  : receiveData.funcao3,
    orientandos : receiveData.orientandos3,
    chs         : receiveData.cargah3
  };
}


function addAtividade3(receiveData) {
 // data = receiveData.data;
  receiveData = tradaDados3(receiveData);
  data3.push(receiveData);
  insereTable3(receiveData);
  fecharModalAtv3();
}

function updateAtividade3(receiveData){
  data = tradaDados3(receiveData);

  data3[receiveData.idx3] = data;

  let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[receiveData.idx3];

  let tipo;
  switch (data.tp) {
    case '1':
      tipo = 'Pesquisa';
      break;
    case '2':
      tipo = 'Extensão e cultura';
      break;
    case '3':
      tipo = 'Outro - informar em observações';
      break;
    default:
      tipo = 'Não definido';
  };

  let func = '';
  switch (data.func) {
    case '1':
      func = 'Coordenador';
      break;
    case '2':
      func = 'Membro';
      break;
    case '3':
      func = 'Programas especiais';
      break;
    default:
      func = 'Não definido';
  };

  linha.cells[1].innerHTML = tipo +': '+ data.nome;
  linha.cells[2].innerHTML = func;
  linha.cells[3].innerHTML = data.orientandos;
  linha.cells[4].innerHTML = data.chs;

  fecharModalAtv3();
  

}

const frmAtv3 = document.getElementById('frmAtv3');
frmAtv3.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv3);
  const data = Object.fromEntries(formData);

  const id = document.getElementById('id3').value;
  if(id === ''){
    addAtividade3(data);
  }else{
    updateAtividade3(data);
  }
  calculaSubt();
})

async function getDBMD3() {
  deleteAllRows3();
  let id_vinc = document.getElementById('id_vinc').value;
  data3 = await fetch(`../api/ativ3.php?at3=${id_vinc}`).then(resp => resp.json()).catch(error => false);
  
  if (data3.length > 0){
    data3.forEach(e => insereTable3(e));
    noData3 = false;
  } else {
    noDataInfo();
    noData3 = true;
  }
  calculaSubt();
  
  //dadosCH();
}

getDBMD3();
