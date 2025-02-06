let data24 = [];
let noData24 = true;
let contador24 = 0;

function deleteAllRowsTable24(){
  $("#tbl24 tbody tr").remove(); 
}

function formatada(dataa){
  var data = new Date(),
      dia  = data.getDate().toString(),
      diaF = (dia.length == 1) ? '0'+dia : dia,
      mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
      mesF = (mes.length == 1) ? '0'+mes : mes,
      anoF = data.getFullYear();
  return diaF+"/"+mesF+"/"+anoF;
}

function insereTable24(newData){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl24").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
  
    let celModalidade  = newLinha.insertCell(0);
    let celTipo        = newLinha.insertCell(1);
    let celPortaria    = newLinha.insertCell(2);
    let celCH          = newLinha.insertCell(3);
    let celInicio      = newLinha.insertCell(4);
    let celFim         = newLinha.insertCell(5);
  
  ch = stripZeros(newData.ch);
  let modalidade = '';

  switch(newData.modalidade){
    case '10': 
      modalidade = 'Médico';
       break;
    case '20':
      modalidade = 'Doutorado';
       break; 
    case '21':
      modalidade = 'Mestrado';
       break; 
    case '22':
     modalidade = 'Pós-Doutorado';
      break; 
  }

  tipo = '';
  switch(newData.tipo){
    case 't': 
      tipo = 'Total';
       break;
    case 'p': 
      tipo = 'Parcial';
        break;
  }
  
  

  let inicio = formatada(newData.dt_inicio);
  let fim = formatada(newData.dt_fim);

  celModalidade.innerHTML  = modalidade;
  celTipo.innerHTML        = tipo;
  celPortaria.innerHTML    = newData.portaria;
  celCH.innerHTML          = ch;
  celInicio.innerHTML      = inicio;
  celFim.innerHTML         = fim;

  celInicio.style.textAlign = 'center';
  celFim.style.textAlign = 'center';

  celCH.style.textAlign = 'center';
  /* celAtividade.style.textAlign = 'center';

  celDisciplina.style.lineHeight = '0.9';
  celCurso.style.lineHeight = '0.9';
  celTurno.style.textAlign = 'center';
  celCh1.style.textAlign = 'right';
  
  */
  
}


async function getDBMD24(){
    let data24t = []
    data24t = await fetch(`../api/ativ24.php?vc=${id_vinc.value}`).then(resp => resp.json()).catch(error => false);
  
    if (contador24 === 0 ){  
      deleteAllRowsTable24();
      data24 = data24t;
      if (data24.length > 0) {
        data24.forEach(e => insereTable24(e));
      }
    } else if (data24t !== data24) {
      data24 = data24t;
      if (data24.length > 0) {
        data24.forEach(e => insereTable24(e));
      }
    }
    if (contador24 === 700){
      contador24 = 0;
    }
    
    let ch24Total = data24.reduce((a, b) => a + parseFloat(b.ch), 0);
    
    total24.innerHTML = parseFloat(ch24Total) + 'h';
}



const myInterval24 = window.setInterval(function() {
  getDBMD24()
}, 8500);

getDBMD24();