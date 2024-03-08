let data23 = [];


function excluirLinhaTbl(idr) {
  let idx = data23.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    data23.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
}


function removVinc23(){
  const id = document.getElementById('idAtivDel').value;
  fetch(`./includes/dml/delete.php?id=${id}` , {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json'
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
  $('#modalDel').modal('hide');
}  

function addVinculo23(receiveData) {
  data = receiveData.data; 
  data23.push(data);
  insereTable(data);
}
/*
const frmAtv = document.getElementById('frmAtv');
frmAtv.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv);
  const data = Object.fromEntries(formData);
  delete data.listaFunc;
  delete data.filtro;
 // const id = document.getElementById('id').value;
 // if(id === ''){

    fetch('./includes/dml/insert.php', {
      method:'POST',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then( data => addVinculo23(data));
/*  }else{
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
  */
 // fecharFormAddAtv();

//});

function deleteAllRowsTable(){
  $("#tabelaAtrib tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
  let celId         = newLinha.insertCell(0);
  let celProf       = newLinha.insertCell(1);
  let celAtividade  = newLinha.insertCell(2);
  let celNome       = newLinha.insertCell(3);
  let celCh         = newLinha.insertCell(4);
  let celDel        = newLinha.insertCell(5);

let txtAtv = '';
switch(newDisc.atividade){
  case '1': 
     txtAtv = 'Projeto de ensino';
     break;
  case '2':
    txtAtv = 'Monitoria';
     break; 
}

celId.innerHTML         = newDisc.id;
celProf.innerHTML       = newDisc.professor;
celAtividade.innerHTML  = txtAtv; 
celNome.innerHTML       = newDisc.nome_atividade;
celCh.innerHTML         = newDisc.ch;

celId.style.display = 'none'; 
celCh.textAlign = 'right';
if(!newDisc.aprov_co_id){
  celDel.innerHTML   =
    `<center>
      <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('${newDisc.id}')">⛔</button>
    </center>`;
 }  else {
  celDel.innerHTML   =
  `<center>
      <button type="button" class="btn btn-light btn-sm"  title="PAD já Aprovado">🔑</button>
    </center>`;

 }
celDel.style.textAlign = 'center';
celCh.style.textAlign = 'right';

}

function formAddAtv(){
  $('#modalAtv').modal('show');
  const formMod = document.getElementById('modalAtv');

    

}
function frmExcluirShow(id){
  let idx = data23.findIndex(d =>d.id === id);
  let myObj = data23[idx];
  $('#modalDel').modal('show'); 
  document.getElementById('nomeRelacao').innerHTML =  
  '<br><sup>Professor(a)</sup>  '+ myObj.professor + '<br /> <sup>Projeto/Curso(a)</sup>  ' + myObj.nome_atividade;
 
  document.getElementById('idAtivDel').value = id;
  
}


function fecharModalDel(){            
  $('#modalDel').modal('hide');
}

function fecharFormAddAtv(){
  $('#modalAtv').modal('hide');

}
 
async function getDBMD(){
  data23 = await fetch(`../api/ativ23att.php?ca=${co_id}${ano}`).then(resp => resp.json()).catch(error => false);
  deleteAllRowsTable();
  data23.forEach(e => insereTable(e));
}

getDBMD();