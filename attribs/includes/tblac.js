let dataCargo = [];


function excluirLinhaTbl(idr) {
  let idx = dataCargo.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    dataCargo.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
}


function removCargo(){
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




function deleteAllRowsTable(){
  $("#tabelaAtrib tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celId    = newLinha.insertCell(0);
    let celNome  = newLinha.insertCell(1);
    let celTipo  = newLinha.insertCell(2);
    let celDel   = newLinha.insertCell(3);
    
    let nome = newDisc.nome;
    nome = nome.concat('<br><sup>',newDisc.codcam.toUpperCase(),'/',newDisc.codcentro,' ',newDisc.colegiado,'</sup>');
    
  celId.innerHTML    = newDisc.id;
  celNome.innerHTML  = nome; //.concat('<br><sup>',strtoupper(newDisc.codcam),'/',newDisc.codcentro,' ',newDisc.colegiado,'</sup>');
  celTipo.innerHTML  = newDisc.tipo;

  if(!newDisc.aprov_co_id){
    celDel.innerHTML   =
      `<center>
        <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow('${newDisc.id}')">⛔</button>
      </center>`;
   }  else {
    celDel.innerHTML   =
    `<center>
        <button type="button" class="btn btn-light btn-sm"  title="PAP Homologado">🔑</button>
      </center>`;

   }
  celId.style.display = 'none'; 
  celDel.style.textAlign = 'center';
}

function formAddAtv(){
  $('#modalAtv').modal('show');
  const formMod = document.getElementById('modalAtv');

}

function ativaBTN(){
  const opt1 = document.getElementById('listaFunc');
  const opt2 = document.getElementById('listaProf');
  const addBtnF = document.getElementById('addBtnF');
  if((opt1.value != -1) & (opt2.value.length > 5) ){
    addBtnF.disabled = false;
  } else {
    addBtnF.disabled = true;
  }
}

function frmExcluirShow(id){
  let idx = dataCargo.findIndex(d =>d.id === id);
  let myObj = dataCargo[idx];
  $('#modalDel').modal('show');
  document.getElementById('nomeRelacao').innerHTML =   myObj.nome + ' <br> ' + myObj.tipo;
  document.getElementById('idAtivDel').value = myObj.id;
}

function fecharModalDel(){            
  $('#modalDel').modal('hide');
}


function fecharFormAddAtv(){
  $('#modalAtv').modal('hide');
}

async function getDBMD(){
  dataCargo = await fetch(`../api/cargo.php?ca=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  deleteAllRowsTable();
  dataCargo.forEach(e => insereTable(e));
}

getDBMD();