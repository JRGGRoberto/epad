<div class="container mt-3">
    <h1>Atribuição de professores as disciplinas</h1>

    <hr>

    


    <div class="form-group">
      Nome: <?= $matriz->nome ?>
    </div>

    <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">

      <table id="tabelaMatD" name="tabelaMatD" class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="display: none;">ID</th>
            <th>Disciplina</th>
            <th>Carga horária</th>
            <th>Série</th>
            <th>Professor(ª)</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
<script>

let disciplinas = [];
let noData = true;


function deleteAllRows(){
    $("#tabelaMatD tbody tr").remove(); 
}

function removeLinhaSemDados(){
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  tabela.deleteRow(0);
}

function noDataInfo(){
  tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  newLinha = tabela.insertRow();
  newCel = newLinha.insertCell();
  newCel.textContent = "Dados não atribuidos";
  newCel.colSpan = 5;
  newCel.style.textAlign = "center";
}

function frmExcluirShow(id){
  $('#modalDel').modal('show');
  alert(id);
  /*
  let nomeDisDel = document.getElementById('nomeDisDel');
  let id_disDel = document.getElementById('id_disDel');
  let index = disciplinas.findIndex(e => e.id === id);
  let myObj = disciplinas[index];
  nomeDisDel.innerHTML =  myObj.nome;
  id_disDel.value = myObj.id;
  */
}


function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
    let celId    = newLinha.insertCell(0);
    let celDisc  = newLinha.insertCell(1);
    let celCh    = newLinha.insertCell(2);
    let celSerie = newLinha.insertCell(3);
    let celDelet = newLinha.insertCell(4);
  celId.innerHTML    = newDisc.id;
  celDisc.innerHTML  = newDisc.nome;
  celSerie.innerHTML = newDisc.serie;
  celCh.innerHTML    = newDisc.ch;
  celDelet.innerHTML  = 'Nome professor vinculo';
  celId.style.display = 'none';
}

function updateDisciplina(receiveData){
  data = receiveData.data;
  disciplinas[data.idx] = {
    nome: data.nome,
    ch: data.ch,
    serie: data.serie,
    id: data.id
  };
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];
  linha.cells[1].innerHTML = data.nome;
  linha.cells[2].innerHTML = data.ch;
  linha.cells[3].innerHTML = data.serie;
}

function addDisciplina(receiveData) {
  data = receiveData.data;
  disciplinas.push(data);
  dadosCH();
  noData ? removeLinhaSemDados(): null;
  insereTable(data);
}


/*
formM.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(formM);
    const data = Object.fromEntries(formData);


    // Se tiver ID é uma edição se não ADD
    const id = document.getElementById('id').value;
    if(id === '') {
      fetch('./dml/insert.php', {
          method:'POST',
          headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then( data => addDisciplina(data));
      fecharModalDis();
    } else {
      fetch('./dml/update.php', {
          method:'PUT',
          headers:{
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
      })
      .then( res => res.json())
      .then( data => updateDisciplina(data));
      fecharModalDis();
    }
});
*/


async function getDBMD(id) {
  deleteAllRows();
  disciplinas = await fetch(`../api/discip.php?mat=${id}`).then(resp => resp.json()).catch(error => false);
  
  if (disciplinas.length > 0){
    disciplinas.forEach(e => insereTable(e));
    noData = false;
  } else {
    noDataInfo();
    noData = true;
  }
  dadosCH();
}

</script>


<?php


echo "
<script> 
  getDBMD('". $matriz['id'] ."');
 </script>";


 echo 'ok';