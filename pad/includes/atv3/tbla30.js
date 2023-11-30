let data3 = [ ];
let noData3 = true;



function deleteAllRows3(){
  $("#tbl3 tbody tr").remove(); 
}

function calculaSubt3(){
  total3.innerHTML = data3.reduce((a, b) => a + parseFloat(b.ch), 0);
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
    switch (newDisc.atividade) {
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
    switch (newDisc.funcao) {
      case '1':
        func = 'Coordenador';
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
  celCH.innerHTML         = newDisc.ch;
  celDelet.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('a3${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar3('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none'; 
  
  celFunc.style.textAlign = 'center';
    celCH.style.textAlign = 'right';
}

function formAddAtv3() {
  clearModal3();
  document.getElementById("titleMotal3").innerHTML = 'Adicionar atividade';
  document.getElementById("addAtv3").innerHTML = "Adicionar";
  let id_vinc = document.getElementById('id_vinc').value;
  document.getElementById("vinc3").value = id_vinc;

  
  $('#modalAtv3').modal('show');
}

function clearModal3(){
  document.getElementById('id3').value = '';
  document.getElementById('idx3').value = '';
  document.getElementById('tpProj3').value = '';
  document.getElementById('nome3').value = '';
  document.getElementById('funcao3').value = '';
  document.getElementById('orientandos3').value = '';
  document.getElementById('cargah3').value = '';
}

function formEditar3(id) {
  let idx3 = data3.findIndex(d =>d.id === id);
  let myObj = data3[idx3];
  let id_vinc = document.getElementById('id_vinc').value;
  document.getElementById("vinc3").value = id_vinc;
  document.getElementById("idx3").value = idx3;
  document.getElementById("id3").value  = myObj.id;
  document.getElementById('tpProj3').value = myObj.atividade;
  document.getElementById('nome3').value = myObj.nome;
  document.getElementById('funcao3').value =myObj.funcao;
  document.getElementById('orientandos3').value = myObj.orientandos;
  document.getElementById('cargah3').value = myObj.ch;

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
    id          : receiveData.id3,
    vinculo     : receiveData.vinc3, 		
    atividade	  : receiveData.tpProj3,
    nome	      : receiveData.nome3,
    funcao	    : receiveData.funcao3,
    orientandos : receiveData.orientandos3,
    ch          : receiveData.cargah3,
    idx         : receiveData.idx3
  };
}


function addAtividade3(receiveData) {
  data = receiveData.data; 
  receiveData = tradaDados3(data);
  data3.push(receiveData);
  insereTable3(receiveData);
  calculaSubt3();
}

function updateAtividade3(receiveData){
  data = tradaDados3(receiveData.data);
  data3[data.idx] = data;
  let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];

  let tipo;
  switch (data.atividade) {
    case '1':
      tipo = 'Pesquisa';
      break;
    case '2':
      tipo = 'Extensão e cultura';
      break;
    case '3':
      tipo = 'Outro(s) - informar em observações';
      break;
    default:
      tipo = 'Não definido';
  };

  let func = '';
  switch (data.funcao) {
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
  linha.cells[4].innerHTML = data.ch;

  calculaSubt3();
}

const frmAtv3 = document.getElementById('frmAtv3');
frmAtv3.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv3);
  const data = Object.fromEntries(formData);

  const id = document.getElementById('id3').value;
  if(id === ''){
    fetch('./includes/atv3/dml/insert.php', {
      method:'POST',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then( data => addAtividade3(data));
  }else{
    fetch('./includes/atv3/dml/update.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then( res => res.json())
    .then( data => updateAtividade3(data));
  }
  fecharModalAtv3();
  
});

function excluirLinhaTbl3(idr) {
  console.log(`Mensagem: ${idr.message}`);
  console.log(`ID: ${idr.id}`);
  let idx = data3.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    data3.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
  calculaSubt3();
}


function removAtiv3(id){
  fetch(`./includes/atv3/dml/delete.php?id=${id}` , {
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
  .then(data => excluirLinhaTbl3(data) )
  .catch(error => {
      console.error(error);
  });
  $('#modalDel').modal('hide');
}


async function getDBMD3() {
  deleteAllRows3();
  let id_vinc = document.getElementById('id_vinc').value;
  data3 = await fetch(`../api/ativ3.php?at3=${id_vinc}`).then(resp => resp.json()).catch(error => false);
  
  if (data3.length > 0){
    data3.forEach(e => insereTable3(e));
    noData3 = false;
  } else {
    //noDataInfo();
    noData3 = true;
  }
  calculaSubt3();
  
  //dadosCH();
}

getDBMD3();
