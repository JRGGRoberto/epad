let data22 = [];
let noData22 = true;
let contador22 = 0;

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

async function getDBMD22(){
  let data22t = []
  data22t = await fetch(`../api/ativ22.php?vc=${id_vinc.value}`).then(resp => resp.json()).catch(error => false);

  if (contador22 == 0){
    deleteAllRowsTable22();
    data22 = data22t;
    if (data22.length > 0) {
      data22.forEach(e => insereTable22(e));
    }
  } else if (data22t != data22){
    data22 = data22t;
    if (data22.length > 0) {
      data22.forEach(e => insereTable22(e));
    }
  }
  if (contador22 === 700){
    contador22 = 0;
  }
  
  
  let ch1Total = data22.reduce((a, b) => a + parseFloat(b.ch), 0);
  let ch2Total = data22.reduce((a, b) => a + parseFloat(b.ch), 0);
  total22.innerHTML = parseFloat((ch1Total + ch2Total)/2) + 'h';
}

const myInterval22 = window.setInterval(function() {
  getDBMD22()
}, 4500);

getDBMD22();