let data23 = [];
let noData23 = true;
let contador23 = 0;

function deleteAllRowsTable23(){
  $("#tbl23 tbody tr").remove(); 
}

function insereTable23(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl23").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celId         = newLinha.insertCell(0);
    let celAtividade  = newLinha.insertCell(1);
    let celNome       = newLinha.insertCell(2);
    let celCh         = newLinha.insertCell(3);
  
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
  celAtividade.innerHTML  = txtAtv; 
  celNome.innerHTML       = newDisc.nome_atividade;
  celCh.innerHTML         = newDisc.ch;

  celId.style.display = 'none'; 
  celCh.textAlign = 'right';

}

async function getDBMD23(){
  let data23t = []
  data23t = await fetch(`../api/ativ23.php?vc=${id_vinc.value}`).then(resp => resp.json()).catch(error => false);

  if (contador23 == 0){
    deleteAllRowsTable23();
    data23 = data23t;
    if (data23.length > 0) {
      data23.forEach(e => insereTable23(e));
    }
  } else if (data23t != data23){
    data23 = data23t;
    if (data23.length > 0) {
      data23.forEach(e => insereTable23(e));
    }
  }
  if (contador23 === 700){
    contador23 = 0;
  }
  
  
  let ch23Total = data23.reduce((a, b) => a + parseFloat(b.ch), 0);
  total23.innerHTML = parseFloat(ch23Total) + 'h';
}

const myInterval23 = window.setInterval(function() {
  getDBMD23()
}, 4500);

getDBMD23();