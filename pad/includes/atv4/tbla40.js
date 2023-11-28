let data4 = [ ];
let noData4 = true;

function deleteAllRows4(){
  $("#tbl4 tbody tr").remove(); 
}

function calculaSubt4(){
  total4.innerHTML = data4.reduce((a, b) => a + parseFloat(b.ch), 0);
}

function insereTable4(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
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
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow4('t4${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar4('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none'; 
  
  celFunc.style.textAlign = 'center';
    celCH.style.textAlign = 'right';
  

}

function formAddAtv4() {
  clearModal4();
  document.getElementById("titleMotal4").innerHTML = 'Adicionar atividade';
  document.getElementById("addAtv4").innerHTML = "Adicionar";
  let id_vinc = document.getElementById('id_vinc').value;
  document.getElementById("vinc4").value = id_vinc;

  
  $('#modalAtv4').modal('show');
}

function clearModal4(){
  document.getElementById('id4').value = '';
  document.getElementById('idx4').value = '';
  document.getElementById('tpProj4').value = '';
  document.getElementById('nome4').value = '';
  document.getElementById('funcao4').value = '';
  document.getElementById('orientandos4').value = '';
  document.getElementById('cargah4').value = '';
}

function formEditar4(id) {
  let idx4 = data4.findIndex(d =>d.id === id);
  let myObj = data4[idx4];
  let id_vinc = document.getElementById('id_vinc').value;
  document.getElementById("vinc4").value = id_vinc;
  document.getElementById("idx4").value = idx4;
  document.getElementById("id4").value  = myObj.id;
  document.getElementById('tpProj4').value = myObj.atividade;
  document.getElementById('nome4').value = myObj.nome;
  document.getElementById('funcao4').value =myObj.funcao;
  document.getElementById('orientandos4').value = myObj.orientandos;
  document.getElementById('cargah4').value = myObj.ch;

  document.getElementById("titleMotal4").innerHTML = 'Editar atividade';
  document.getElementById("addAtv4").innerHTML = "Alterar";

  $('#modalAtv4').modal('show');
}


function fecharModalAtv4() {
  clearModal4();
  $('#modalAtv4').modal('hide');
}

function tradaDados4(receiveData){
  return dados = {
    id          : receiveData.id4,
    vinculo     : receiveData.vinc4, 		
    atividade	  : receiveData.tpProj4,
    nome	      : receiveData.nome4,
    funcao	    : receiveData.funcao4,
    orientandos : receiveData.orientandos4,
    ch          : receiveData.cargah4,
    idx         : receiveData.idx4
  };
}


function addAtividade4(receiveData) {
  data = receiveData.data; 
  receiveData = tradaDados4(data);
  data4.push(receiveData);
  insereTable4(receiveData);
  fecharModalAtv4();
}

function updateAtividade4(receiveData){
  data = tradaDados4(receiveData.data);
  data4[data.idx] = data;
  let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
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

  fecharModalAtv4();
  

}

const frmAtv4 = document.getElementById('frmAtv4');
frmAtv4.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv4);
  const data = Object.fromEntries(formData);

  const id = document.getElementById('id4').value;
  if(id === ''){
    fetch('./includes/atv4/dml/insert.php', {
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
  fecharModalAtv4();
  calculaSubt4();
})

async function getDBMD4() {
  deleteAllRows4();
  let id_vinc = document.getElementById('id_vinc').value;
  data4 = await fetch(`../api/ativ3.php?at3=${id_vinc}`).then(resp => resp.json()).catch(error => false);
  
  if (data4.length > 0){
    data4.forEach(e => insereTable3(e));
    noData4 = false;
  } else {
    noDataInfo();
    noData4 = true;
  }
  calculaSubt4();
  
  //dadosCH();
}

getDBMD4();
