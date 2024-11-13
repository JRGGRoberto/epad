let data = [];
let noData22 = true;

let DoubleClick = document.getElementById('DoubleClick');


function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
}

function deleteAllRows(){
  data = [];
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
    let celAprovCoid = newLinha.insertCell(10);
    let celCnf  = newLinha.insertCell(11);
    
    //let AssingCoorden =  typeof newLinha.aprov_co_id !== 'undefined' ? ( newLinha.aprov_co_id === 36 ? '✅' :  '⏳'): '⏳';
    let AssingCoorden =  newDisc.aprov_co_id === null ? '⏳':  '✅' ;

    
    let totUsado = parseFloat(newDisc.a21) + parseFloat(newDisc.a22) +parseFloat(newDisc.a23) +parseFloat(newDisc.a3) + parseFloat(newDisc.a4);
    celId.innerHTML   = newDisc.id;
    celNome.innerHTML = newDisc.nome + '<br><sub>'+ newDisc.colegiado +'</sub>';
    celLink.innerHTML = '<a href="../padstoprn/index.php?id='+ newDisc.id +'" target="_blank">📄</a> ';
    celA21.innerHTML  = stripZeros(newDisc.a21) +'h ';
    celA22.innerHTML  = newDisc.a22 +'h ';
    celA23.innerHTML  = newDisc.a23 +'h ';
    celA3.innerHTML   = newDisc.a3 +'h ';
    celA4.innerHTML   = newDisc.a4 +'h ';
    celAT.innerHTML   = totUsado +'h ';
    celAprovCoid.innerHTML =  AssingCoorden;


  if(newDisc.rt === 'TIDE'){
    celRT.innerHTML   = newDisc.rt;
  } else {
    celRT.innerHTML   = newDisc.rt +'h ';
  }
  if(newDisc.rt == 'TIDE'){
    newDisc.rt = 40;
  }

  if(((newDisc.aprov_co_id === null) || (newDisc.aprov_co_id === ''))) {
    celCnf.innerHTML  = 
      `<center>
      <button type="button" class="btn btn-light btn-sm" title="??">⏳</button>
      </center>`;
  } else {
    if ((newDisc.aprov_ce_id === null) | (newDisc.aprov_ce_id === '')){
      celCnf.innerHTML  = 
         `<center>
            <button type="button" class="btn btn-light btn-sm" title="Homologar PAD" onclick="frmAtivShow('${newDisc.id}')">🖋️</button>
         </center>`;
    } else {
      celCnf.innerHTML  = 
         `<center>
            <button type="button" class="btn btn-light btn-sm" title="Remover homologação" onclick="frmmodalDel('${newDisc.id}')">✏️</button>
         </center>`;

    }
  }

  celNome.style.lineHeight = '0.9';
  celId.style.display = 'none'; 
  celLink.style.textAlign = 'center';
  celA21.style.textAlign = 'right';
  celA22.style.textAlign = 'right';
  celA23.style.textAlign = 'right';
  celA3.style.textAlign = 'right';
  celA4.style.textAlign = 'right';
  celAT.style.textAlign = 'right';
  celRT.style.textAlign = 'right';
  celAprovCoid.style.textAlign = 'center';


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
  let vinc_id_ce;
  let tdo = ad;
  
  if(tdo == 'a'){
    vinc_idps  = document.getElementById('vinc_idps').value;
    vinc_id_ce = document.getElementById('vinc_id_ce').value;
  } else if (tdo == 'd'){
    vinc_idps  = document.getElementById('vinc_idpsd').value;
    vinc_id_ce = document.getElementById('vinc_id_ce').value;
  } else {
    console.log('error ' + tdo);
    return;
  }
  
  let datasing = {
    to_do: tdo,
    id_vin: vinc_idps,
    id_user: vinc_id_ce
  };

  const data = datasing;
  console.log(data);

  fetch('./dml/sing_ce.php', {
      method:'PUT',
      headers:{
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
  .then( res => res.json())
  .then( res => console.log(res)
  );

  if(tdo == 'a'){ 
    fecharModal();
  } else {
    fecharModalDel()
  }

  getDBMD();
}


async function getDBMD() {
  deleteAllRows();
  data = await fetch(`../api/padsce.php?md=${ce}${ano}`).then(resp => resp.json()).catch(error => false);
  if (data.length > 0){
    data.forEach(e => insereTable(e));
   } 
}

getDBMD();


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





