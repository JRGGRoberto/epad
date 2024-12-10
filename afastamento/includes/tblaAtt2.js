/*

let data22 = [];


function excluirLinhaTbl(idr) {
  let idx = data22.findIndex(d =>d.id === idr.id);
  if(idx > -1){
    let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
    tabela.deleteRow(idx);
    data22.splice(idx, 1);
  } else {
    console.log(`Não encontrado ${idr.id}`);
  }
}


function removVinc22(){
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

function addVinculo22(receiveData) {
  data = receiveData.data; 
  data22.push(data);
  insereTable(data);
}

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
    .then( data => addVinculo22(data));
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
 /*
  fecharFormAddAtv();

});

function deleteAllRowsTable(){
  $("#tabelaAtrib tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaAtrib").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celId    = newLinha.insertCell(0);
    let celProf  = newLinha.insertCell(1);
    let celLink  = newLinha.insertCell(2);
    let celAluno = newLinha.insertCell(3);
    let celSerie = newLinha.insertCell(4);
    let celCH    = newLinha.insertCell(5);
    let celDel   = newLinha.insertCell(6);
   
  celId.innerHTML    = newDisc.id;
  celProf.innerHTML  = `${newDisc.orientador}<br><br>
    <sup>${newDisc.codcam_orientador.toUpperCase()}/${newDisc.codcentro_orientador} - ${newDisc.colegiado_orientador} 
    </sup>`;
  celLink.innerHTML = '<a href="../padstoprn/index.php?id='+ newDisc.vinculo +'" target="_blank">📄</a> ';
  celAluno.innerHTML = newDisc.estudante;
  celCH.innerHTML    = newDisc.ch + 'h';
  celSerie.innerHTML = newDisc.serie + 'ª série';
  
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
  celLink.style.textAlign = 'center';
  celCH.style.textAlign = 'center';
  celSerie.style.textAlign = 'center';
}
*/
function formAddAtv(){
  $('#modalAtv').modal('show');
  const formMod = document.getElementById('modalAtv');
}

/*
function frmExcluirShow(id){
  let idx = data22.findIndex(d =>d.id === id);
  let myObj = data22[idx];
  $('#modalDel').modal('show'); 
  document.getElementById('nomeRelacao').innerHTML =  
  '<br><sup>Professor(a)</sup>'+ myObj.orientador + '<br /> <sup>Aluno(a)</sup>' + myObj.estudante;
  document.getElementById('idAtivDel').value = myObj.id;
}
*/

function fecharModalDel(){            
  $('#modalDel').modal('hide');
}

function fecharFormAddAtv(){
  $('#modalAtv').modal('show');

}

/*
 
async function getDBMD(){
  console.log('co: '+ co_id + '| ano: '+ ano+ '| tipo: '+ tipo);

  data22 = await fetch(`../api/ativ22attr.php?ca=${co_id}${ano}${tipo}`).then(resp => resp.json()).catch(error => false);
  deleteAllRowsTable();
  data22.forEach(e => insereTable(e));
}

getDBMD();

*/