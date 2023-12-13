let data22 = [];
let noData22 = true;

let div_tbl22 = document.getElementById('div_tbl22');
let DoubleClick = document.getElementById('DoubleClick');


function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
}

function deleteAllRows(){
  $("#tabelaPADS tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaPADS").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId   = newLinha.insertCell(0);
    let celNome = newLinha.insertCell(1);
    let celA21  = newLinha.insertCell(2);
    let celA22  = newLinha.insertCell(3);
    let celA3   = newLinha.insertCell(4);
    let celA4   = newLinha.insertCell(5);
    let celAT   = newLinha.insertCell(6);
    let celRT   = newLinha.insertCell(7);
    let celCnf  = newLinha.insertCell(8);
      
  celId.innerHTML   = newDisc.id;
  celNome.innerHTML = newDisc.nome;
  celA21.innerHTML  = stripZeros(newDisc.a21) +'h ';
  celA22.innerHTML  = newDisc.a22 +'h ';
  celA3.innerHTML   = newDisc.a3 +'h ';
  celA4.innerHTML   = newDisc.a4 +'h ';
  celAT.innerHTML   = parseFloat(newDisc.a21) + parseFloat(newDisc.a22) +parseFloat(newDisc.a3) + parseFloat(newDisc.a4) +'h ';
  celRT.innerHTML   = newDisc.rt +'h ';
  celCnf.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmAtiv22Show('${newDisc.id}')">⚙️</button>
  </center>`;
  celId.style.display = 'none'; 
  celA21.style.textAlign = 'right';
  celA22.style.textAlign = 'right';
  celA3.style.textAlign = 'right';
  celA4.style.textAlign = 'right';
  celAT.style.textAlign = 'right';
  celRT.style.textAlign = 'right';

  
  //celCH.style.textAlign = 'right';
}

async function getDBMD() {
  deleteAllRows();
  data = await fetch(`../api/pads.php?md=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  if (data.length > 0){
    data.forEach(e => insereTable(e));
   } 
}

getDBMD();


function frmAtiv22Show(id) {
  btnFecharCanc();
  getDBMD22(id);
  $('#modalAtv').modal('show');
  
  document.getElementById('vinc22').value = id;
}


var tbodyAtv = document.getElementById("tbodyAtv");
tbodyAtv.ondblclick = function(e){
  e = e || window.event;
  var target = e.srcElement || e.target;
  
  while (target && target.nodeName !== "TR") {
      target = target.parentNode;
  }
  if (target) {
    var cells = target.getElementsByTagName("td");
    btnShowAddfnc();
    let index = data22.findIndex(e => e.id === cells[0].innerHTML);
    let myObj = data22[index];

    document.getElementById('id22').value     = myObj.id;
    document.getElementById('idx22').value    = index;
    document.getElementById('tpAtiv22').value = myObj.atividade;
    document.getElementById('nome22F').value  = myObj.estudante;
    document.getElementById('curso22F').value = myObj.curso;
    document.getElementById('serie22F').value = myObj.serie;

    document.getElementById('addEdt22').innerHTML = 'Alterar';
  }
}

function btnShowAddfnc(){ 
  document.getElementById('id22').value     = '';
  document.getElementById('idx22').value    = '';
  
  document.getElementById('tpAtiv22').value = '';
  document.getElementById('nome22F').value  = '';
  document.getElementById('curso22F').value = '';
  document.getElementById('serie22F').value = '';
  frmAtv22.hidden = false;
  btnShowAdd.hidden = true;
  div_tbl22.hidden = true;
  DoubleClick.hidden = true;
  document.getElementById('addEdt22').innerHTML = 'Adicionar';
}

function btnFecharCanc(){
    frmAtv22.hidden = true;
    btnShowAdd.hidden = false;
    div_tbl22.hidden = false;
}

function deleteAllRowsTable22(){
  $("#tbl22 tbody tr").remove(); 
}

function insereTable22(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl22").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celId         = newLinha.insertCell(0);
    let celAtividade  = newLinha.insertCell(1);
    let celEstudante = newLinha.insertCell(2);
    let celCurso      = newLinha.insertCell(3);
    let celSerie      = newLinha.insertCell(4);
    let celCh1        = newLinha.insertCell(5);
    let celCh2        = newLinha.insertCell(6);
    let celDel        = newLinha.insertCell(7);
    
  celId.innerHTML          = newDisc.id;
  celAtividade.innerHTML   = newDisc.atividade;
  celEstudante.innerHTML   = newDisc.estudante;
  celCurso.innerHTML       = newDisc.curso;
  celSerie.innerHTML       = newDisc.serie;
  let cargaHoraria = newDisc.ch;
  if (newDisc.atividade === 'c'){
    cargaHoraria = cargaHoraria * 1.5;
    newDisc.ch = cargaHoraria;
  }
  celCh1.innerHTML         = cargaHoraria;
  celCh2.innerHTML         = cargaHoraria;
  celDel.innerHTML         =
  `<center>
  <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow22('${newDisc.id}')">⛔</button>
</center>`;
  
  celId.style.display = 'none'; 
  celAtividade.style.textAlign = 'center';
  celSerie.style.textAlign = 'center';
  celCh1.style.textAlign = 'right';
  celCh2.style.textAlign = 'right';
}

function addAtividade22(receiveData) {
  data = receiveData.data; 
  //receiveData = tradaDados4(data);
  data22.push(data);
  insereTable22(data);
  //calculaSubt4();
}


function updateAtividade22(receiveData){
  console.log(receiveData)
/*  data = tradaDados4(receiveData.data);
  data4[data.idx] = data;
  let tabela = document.getElementById("tbl4").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];

  linha.cells[1].innerHTML = data.cargo;
  linha.cells[2].innerHTML = data.alocado;
  linha.cells[3].innerHTML = data.numdata;
  linha.cells[4].innerHTML = data.ch;
*/
}

const frmAtv22 = document.getElementById('frmAtv22');
frmAtv22.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv22);
  const data = Object.fromEntries(formData);

  console.table(data);

  const id = document.getElementById('id22').value;
  if(id === ''){
    console.log('insert');
    fetch('./includes/dml/insert.php', {
      method:'POST',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then( data => addAtividade22(data)); 
  }else{
    console.log('update');
  
    fetch('./includes/dml/update.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then( res => res.json())
    .then( data => updateAtividade22(data)); 
  }
  btnFecharCanc();
  //$('#modalAtv').modal('hide');
});



async function getDBMD22(id){
  data22 = await fetch(`../api/ativ22.php?vc=${id}`).then(resp => resp.json()).catch(error => false);
  deleteAllRowsTable22();
  if (data22.length > 0) {
    data22.forEach(e => insereTable22(e));
    DoubleClick.hidden = false;
  } else {
    DoubleClick.hidden = true;
  }
}
