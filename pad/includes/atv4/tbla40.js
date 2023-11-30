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
    let celCargo      = newLinha.insertCell(1);
    let celAlocado    = newLinha.insertCell(2);
    let celNumdata    = newLinha.insertCell(3);
    let celCH         = newLinha.insertCell(4);
    let celDelet      = newLinha.insertCell(5);
    
      
  celId.innerHTML      = newDisc.id;
  celCargo.innerHTML   = newDisc.cargo;
  celAlocado.innerHTML = newDisc.alocado;
  celNumdata.innerHTML = newDisc.numdata;
  celCH.innerHTML      = newDisc.ch;
  celDelet.innerHTML   = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('a4${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar4('${newDisc.id}')">✏️</button>
  </center>`;
  celId.style.display = 'none'; 
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
  document.getElementById('cargo4').value = '';
  document.getElementById('alocado4').value = '';
  document.getElementById('numdata4').value = '';
  document.getElementById('cargah4').value = '';
  
}

function formEditar4(id) {
  let idx4 = data4.findIndex(d =>d.id === id);
  let myObj = data4[idx4];
  let id_vinc = document.getElementById('id_vinc').value;

  document.getElementById("vinc4").value = id_vinc;
  document.getElementById("idx4").value = idx4;
  document.getElementById("id4").value  = myObj.id;
  document.getElementById('cargo4').value = myObj.cargo;

  document.getElementById('alocado4').value = myObj.alocado;
  document.getElementById('numdata4').value = myObj.numdata;
  
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

const frmAtv4 = document.getElementById('frmAtv4');
frmAtv4.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv4);
  const data = Object.fromEntries(formData);

     console.log(data);

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
    .then( data => addAtividade4(data));
  }else{
    fetch('./includes/atv4/dml/update.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then( res => res.json())
    .then( data => updateAtividade4(data));
  }
  fecharModalAtv4();
});

function excluirLinhaTbl4(idr) {
  console.log(`Mensagem: ${idr.message}`);
  console.log(`ID: ${idr.id}`);
  let idx = data4.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    data4.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
  calculaSubt4();
}


function removAtiv4(id){
  fetch(`./includes/atv4/dml/delete.php?id=${id}` , {
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
  .then(data => excluirLinhaTbl4(data) )
  .catch(error => {
      console.error(error);
  });
  $('#modalDel').modal('hide');
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
