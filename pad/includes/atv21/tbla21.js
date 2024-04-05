let data21 = [];
let noData21 = true;
let contador21 = 0;

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
        turno = '';
    };

  ch = stripZeros(newDisc.cargah);

  if(newDisc.atividade === 'd'){
    newDisc.disciplina = newDisc.disciplina + '<br><sub>(planejamento)</sub>'
  }

  celId.innerHTML          = newDisc.id;
  celAtividade.innerHTML   = newDisc.atividade;
  celDisciplina.innerHTML  = newDisc.disciplina;
  celCurso.innerHTML       = newDisc.curso  + '<br><sub>' + newDisc.curso + " - " + newDisc.campus +'</sub>';
  celTurno.innerHTML       = turno;
  celCh1.innerHTML         = ch;
  

  celId.style.display = 'none'; 
  celAtividade.style.textAlign = 'center';

  celDisciplina.style.lineHeight = '0.9';
  celCurso.style.lineHeight = '0.9';
  celTurno.style.textAlign = 'center';
  celCh1.style.textAlign = 'right';
  
}


async function getDBMD21(){
  let data21t = []
  data21t = await fetch(`../api/pad21.php?vc=${id_vinc.value}`).then(resp => resp.json()).catch(error => false);

  if (contador21 === 0 ){  
    deleteAllRowsTable21();
    data21 = data21t;
    if (data21.length > 0) {
      data21.forEach(e => insereTable21(e));
    }
  } else if (data21t !== data21) {
    deleteAllRowsTable21();
    data21 = data21t;
    if (data21.length > 0) {
      data21.forEach(e => insereTable21(e));
    }
  }
  if (contador21 === 700){
    contador21 = 0;
  }
  
  let ch1Total = data21.reduce((a, b) => a + parseFloat(b.cargah), 0);
  
  total21.innerHTML = parseFloat(ch1Total) + 'h';
 }



const myInterval21 = window.setInterval(function() {
  getDBMD21()
}, 4500);

getDBMD21();