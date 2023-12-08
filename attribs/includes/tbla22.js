let data22 = [];
let noData22 = true;


const  frmAtv = document.getElementById('frmAtv');
let div_tbl22 = document.getElementById('div_tbl22');
let DoubleClick = document.getElementById('DoubleClick');

function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
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
    document.getElementById('tpAtiv22').value = cells[1].innerHTML;
    document.getElementById('nome22F').value  = cells[2].innerHTML;
    document.getElementById('curso22F').value = cells[3].innerHTML;
    document.getElementById('serie22F').value = cells[4].innerHTML;
  }
}

function btnShowAddfnc(){ 
  document.getElementById('tpAtiv22').value = '';
  document.getElementById('nome22F').value = '';
  document.getElementById('curso22F').value ='';
  document.getElementById('serie22F').value ='';
  frmAtv.hidden = false;
  btnShowAdd.hidden = true;
  div_tbl22.hidden = true;
  DoubleClick.hidden = true;
}

function btnFecharCanc(){
    frmAtv.hidden = true;
    btnShowAdd.hidden = false;
    div_tbl22.hidden = false;
}


function frmAtiv22Show(id) {

  btnFecharCanc();
  getDBMD22(id)

  /*
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
  */

  $('#modalAtv').modal('show');
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

  celId.style.display = 'none'; 
  celAtividade.style.textAlign = 'center';
  celSerie.style.textAlign = 'center';
  celCh1.style.textAlign = 'right';
  celCh2.style.textAlign = 'right';
}

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
