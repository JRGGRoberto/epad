let data22 = [];
let noData22 = true;

let DoubleClick = document.getElementById('DoubleClick');


function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
}

function deleteAllRows(){
  data22 = [];
  $("#tabelaPADS tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaPADS").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId   = newLinha.insertCell(0);
    let celNome = newLinha.insertCell(1);
    let celLink = newLinha.insertCell(2);
    let celA21  = newLinha.insertCell(3);
    let celA22  = newLinha.insertCell(4);
    let celA23  = newLinha.insertCell(5);
    let celA3   = newLinha.insertCell(6);
    let celA4   = newLinha.insertCell(7);
    let celAT   = newLinha.insertCell(8);
    let celRT   = newLinha.insertCell(9);
    let celCnf  = newLinha.insertCell(10);
//    let celAprovCoid = newLinha.insertCell(9);
//    let celAprovCeId = newLinha.insertCell(10);
    
    let totUsado = parseFloat(newDisc.a21) + parseFloat(newDisc.a22) +parseFloat(newDisc.a23) +parseFloat(newDisc.a3) + parseFloat(newDisc.a4);
  celId.innerHTML   = newDisc.id;
  celNome.innerHTML = newDisc.nome; 
  celLink.innerHTML = '<a href="../padstoprn/index.php?id='+ newDisc.id +'" target="_blank">📄</a> ';
  celA21.innerHTML  = stripZeros(newDisc.a21) +'h ';
  celA22.innerHTML  = newDisc.a22 +'h ';
  celA23.innerHTML  = newDisc.a23 +'h ';
  celA3.innerHTML   = newDisc.a3 +'h ';
  celA4.innerHTML   = newDisc.a4 +'h ';
  celAT.innerHTML   = totUsado +'h ';

  if(newDisc.rt === 'TIDE'){
    celRT.innerHTML   = newDisc.rt;
  } else {
    celRT.innerHTML   = newDisc.rt +'h ';
  }
  celCnf.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" title="??">?</button>
  </center>`;

  if(newDisc.rt == 'TIDE'){
    newDisc.rt = 40;
  }

  if(!(newDisc.aprov_ce_id === null) ){
    celCnf.innerHTML  = 
       `<center>
         <button type="button" class="btn btn-light btn-sm" title="Assinado pelo Diretor de Centro">🔒</button>
       </center>`;
  } else if (!((newDisc.aprov_co_id === null) || (newDisc.aprov_co_id === ''))){
    celCnf.innerHTML  = 
       `<center>
         <button type="button" class="btn btn-light btn-sm" title="Assinado pelo coordenador, remover assinatura" onclick="frmmodalDel('${newDisc.id}')">✏️</button>
       </center>`;
  } else {
      if ((parseFloat(totUsado)) === (parseFloat(newDisc.rt))) {
        celCnf.innerHTML  = 
         `<center>
           <button type="button" class="btn btn-light btn-sm" title="Aprovar PAD" onclick="frmAtivShow('${newDisc.id}')">🖋️</button>
         </center>`;
      } else {
        celCnf.innerHTML  = 
         `<center>
           <button type="button" class="btn btn-light btn-sm" title="Aprovar PAD")">⏳</button>
         </center>`;
      }
  }

  celId.style.display = 'none'; 
  celLink.style.textAlign = 'center';
  celA21.style.textAlign = 'right';
  celA22.style.textAlign = 'right';
  celA23.style.textAlign = 'right';
  celA3.style.textAlign = 'right';
  celA4.style.textAlign = 'right';
  celAT.style.textAlign = 'right';
  celRT.style.textAlign = 'right';


  if(parseFloat(totUsado) < parseFloat(newDisc.rt)){
    //amarelo
    celAT.style.backgroundColor = '#ffeeba';
    celAT.style.borderBlockColor = '#ffdf7e';
  } else if (parseFloat(totUsado) === parseFloat(newDisc.rt)){
    //verde
    celAT.style.backgroundColor = '#c3e6cb';
    celAT.style.borderBlockColor = '#8fd19e';
  } else {
    //vermelho
    celAT.style.backgroundColor = '#f5c6cb';
    celAT.style.borderBlockColor = '#ed969e';
  }
}


 
function Aprovar(ad){
  let vinc_idps;
  let vinc_id_co;
  let tdo = ad;

  if(tdo == 'a'){
    vinc_idps  = document.getElementById('vinc_idps').value;
    vinc_id_co = document.getElementById('vinc_id_co').value;
  } else if (tdo == 'd'){
    vinc_idps  = document.getElementById('vinc_idpsd').value;
    vinc_id_co = document.getElementById('vinc_id_cod').value;
  } else {
    console.log('error ' + tdo);
    return;
  }
  
  let datasing = {
    to_do: tdo,
    id_vin: vinc_idps,
    id_user: vinc_id_co
  };

  const data = datasing;
  if(tdo == 'a'){
    fetch('./dml/sing_co1.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then( res => res.json());
    fecharModal();
  } else if (tdo == 'd'){

    fetch('./dml/sing_co0.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then( res => res.json());
    fecharModalDel();

  }
  getDBMD();
}

function frmAtivShow(id) {
  $('#modalAtv').modal('show');
 
  document.getElementById('vinc_idps').value = id;

  let index = data.findIndex(e => e.id === id);
  let myObj = data[index];
  
 document.getElementById('titleMotalProf').innerHTML = myObj.nome;
 let txtLocal = document.getElementById('bce').innerHTML;
 let txtData = new Date().toLocaleDateString('pt-br', { day:"numeric" , month:"long", year:"numeric"});
 document.getElementById('dataHoje').innerHTML = txtLocal +', ' + txtData + ".";
}


function frmmodalDel(id) {
  $('#modalDel').modal('show');

  document.getElementById('vinc_idpsd').value = id;

  let index = data.findIndex(e => e.id === id);
  let myObj = data[index];
  document.getElementById('nomeAtivDel').innerHTML = myObj.nome;
 
}

function fecharModalDel(){
  $('#modalDel').modal('hide');
}

function fecharModal(){
  $('#modalAtv').modal('hide');
}



async function getDBMD() {
  deleteAllRows();
  data = await fetch(`../api/pads.php?md=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  if (data.length > 0){
    data.forEach(e => insereTable(e));
   } 
}

getDBMD();
