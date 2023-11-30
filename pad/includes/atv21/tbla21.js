let data21 = [];
let noData21 = true;

function deleteAllRowsTable21(){
  $("#tbl21 tbody tr").remove(); 
}

function insereTable21(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl21").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celId         = newLinha.insertCell(0);
    let celAtividade  = newLinha.insertCell(1);
    let celDisciplina = newLinha.insertCell(2);
    let celCurso      = newLinha.insertCell(3);
    let celTurno      = newLinha.insertCell(4);
    let celCh1        = newLinha.insertCell(5);
    let celCh2        = newLinha.insertCell(6);

    let turno;
    switch (newDisc.turno) {
      case 'm':
        turno = 'Matutino';
        break;
      case 'v':
        turno = 'Vespertino';
        break;
      case 'n':
        turno = 'Noturno';
        break;
      case 'i':
        turno = 'Integral';
        break;
      default:
        turno = 'Não definido';
    };
    
  celId.innerHTML          = newDisc.id;
  celAtividade.innerHTML   = newDisc.atividade;
  celDisciplina.innerHTML  = newDisc.disciplina;
  celCurso.innerHTML       = newDisc.curso;
  celTurno.innerHTML       = turno;
  let cargaHoraria = newDisc.cargah;
  if (newDisc.atividade === 'c'){
    cargaHoraria = cargaHoraria * 1.5;
    newDisc.cargah = cargaHoraria;
  }
  celCh1.innerHTML         = cargaHoraria;
  celCh2.innerHTML         = cargaHoraria;

  celId.style.display = 'none'; 
  celAtividade.style.textAlign = 'center';
  celTurno.style.textAlign = 'center';
  celCh1.style.textAlign = 'right';
  celCh2.style.textAlign = 'right';
}

async function getDBMD21(){
  deleteAllRowsTable21();
  data21 = await fetch(`../api/pad21.php?vc=${id_vinc.value}`).then(resp => resp.json()).catch(error => false);
  if (data21.length > 0) {
    data21.forEach(e => insereTable21(e));
  }
  
  let ch1Total = data21.reduce((a, b) => a + parseFloat(b.cargah), 0);
  let ch2Total = data21.reduce((a, b) => a + parseFloat(b.cargah), 0);
  total21.innerHTML = parseFloat((ch1Total + ch2Total)/2);
 
}



const myInterval21 = window.setInterval(function() {
  getDBMD21()
}, 4500);

getDBMD21();