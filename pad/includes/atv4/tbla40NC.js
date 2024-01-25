let data4 = [ ];
let noData4 = true;


function deleteAllRows4(){
  $("#tbl4 tbody tr").remove(); 
}

function calculaSubt4(){
  total4.innerHTML = data4.reduce((a, b) => a + parseFloat(b.ch), 0) + 'h';
}

function insereTable4(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId         = newLinha.insertCell(0);
    let celCargo      = newLinha.insertCell(1);
    let celAlocado    = newLinha.insertCell(2);
    let celNumdata    = newLinha.insertCell(3);
    let celCH         = newLinha.insertCell(4);
  
    
      
  celId.innerHTML      = newDisc.id;
  celCargo.innerHTML   = newDisc.cargo;
  celAlocado.innerHTML = newDisc.alocado;
  celNumdata.innerHTML = newDisc.numdata;
  celCH.innerHTML      = newDisc.ch;

  celId.style.display = 'none'; 
  celCH.style.textAlign = 'right';
}


function tradaDados4(receiveData){
  return dados = {
    id      : receiveData.id4,
    vinculo : receiveData.vinc4, 		
    cargo	  : receiveData.cargo4,
    alocado : receiveData.alocado4,
    numdata : receiveData.numdata4,
    ch      : receiveData.cargah4,
    idx     : receiveData.idx4
  };
}


function addAtividade4(receiveData) {
  data = receiveData.data; 
  receiveData = tradaDados4(data);
  data4.push(receiveData);
  insereTable4(receiveData);
  calculaSubt4();
}

function updateAtividade4(receiveData){
  data = tradaDados4(receiveData.data);
  data4[data.idx] = data;
  let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];

  linha.cells[1].innerHTML = data.cargo;
  linha.cells[2].innerHTML = data.alocado;
  linha.cells[3].innerHTML = data.numdata;
  linha.cells[4].innerHTML = data.ch;

  calculaSubt4();
}


async function getDBMD4() {
  deleteAllRows4();
  let id_vinc = document.getElementById('id_vinc').value;
  data4 = await fetch(`../api/ativ4.php?at4=${id_vinc}`).then(resp => resp.json()).catch(error => false);
  
  if (data4.length > 0){
    data4.forEach(e => insereTable4(e));
    noData4 = false;
  } else {
    noData4 = true;
  }
  calculaSubt4();
  
  //dadosCH();
}

getDBMD4();
