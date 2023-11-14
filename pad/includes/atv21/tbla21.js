let data21 = [ 
{
  'id': '1',
  'atividade': 'a',
  'disciplina': 'Mídias Tecnológicas para o ensino de Matemática',
  'curso': 'Matemática',
  'turno': 'Noturno',
  'ch1': '2',
  'ch2': '2'
},

{
    'id': '2',
    'atividade': 'a',
    'disciplina': 'Planejamento de Mídias Tecnológicas para o ensino de Matemática',
    'curso': 'Matemática',
    'turno': 'Noturno',
    'ch1': '2',
    'ch2': '2'
  }

];
let noData21 = true;

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
    
  celId.innerHTML          = newDisc.id;
  celAtividade.innerHTML   = newDisc.atividade;
  celDisciplina.innerHTML  = newDisc.disciplina;
  celCurso.innerHTML       = newDisc.curso;
  celTurno.innerHTML       = newDisc.turno;
  celCh1.innerHTML         = newDisc.ch1;
  celCh2.innerHTML         = newDisc.ch2;
  celId.style.display = 'none'; 
}

function getDBMD21(){
  data21.forEach(e => insereTable21(e));
  let ch1Total = data21.reduce((a, b) => a + parseInt(b.ch1), 0);
  let ch2Total = data21.reduce((a, b) => a + parseInt(b.ch2), 0);
  total21.innerHTML = parseInt((ch1Total + ch2Total)/2);
}
