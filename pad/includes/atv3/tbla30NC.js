let data3 = [ ];
let noData3 = true;



function deleteAllRows3(){
  $("#tbl3 tbody tr").remove(); 
}

function calculaSubt3(){
  total3.innerHTML = data3.reduce((a, b) => a + parseFloat(b.ch), 0) + 'h';
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
  celId.style.display = 'none'; 
  
  celFunc.style.textAlign = 'center';
    celCH.style.textAlign = 'right';
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
