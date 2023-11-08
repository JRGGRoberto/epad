let data3 = [
    {
        'idx3': '0',
        'id3': '1',
        'tpProj3': '1',
        'nome3': 'Estudos sobre recursos tecnológicos digitais e seus usos por professores em suas práticas profissionais e em seus processos formativos',
        'funcao3': '1',
        'orientandos3': 'Débora Rengel, Noeli Teresinha Valério de Almeida, Suzana Pereira do Prado, Suely Maria de Souza',
        'cargah3': '8'
    },
    {
        'idx3': '1',
        'id3': '2',
        'tpProj3': '1',
        'nome3': 'Estudos sobre recursos tecnológicos',
        'funcao3': '1',
        'orientandos3': 'Joãozinho',
        'cargah3': '2'
    }
 ];


function insereTable3(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId         = newLinha.insertCell(0);
    let celNome       = newLinha.insertCell(1);
    let celFunc       = newLinha.insertCell(2);
    let celNomeOrient = newLinha.insertCell(3);
    let celCH         = newLinha.insertCell(4);
    let celDelet      = newLinha.insertCell(5);
    let tipo = '';
    switch (newDisc.tpProj3) {
      case '1':
        tipo = 'Pesquisa';
        break;
      case '2':
        tipo = 'Extensão e cultura';
        break;
      case '3':
        tipo = 'Outro - informar em observações';
        break;
      default:
        tipo = 'Não definido';
    };

    let func = '';
    switch (newDisc.funcao3) {
      case '1':
        func = 'Coordenador';
        break;
      case '2':
        func = 'Membro';
        break;
      case '3':
        func = 'Programas especiais';
        break;
      default:
        func = 'Não definido';
    };

  celId.innerHTML         = newDisc.id3;
  celNome.innerHTML       = tipo +': '+ newDisc.nome3;
  celFunc.innerHTML       = func;
  celNomeOrient.innerHTML = newDisc.orientandos3;
  celCH.innerHTML         = newDisc.cargah3;
  celDelet.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow3('${newDisc.id3}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar3('${newDisc.id3}')">✏️</button>
  </center>`;
  celId.style.display = 'none'; 
}

function formTeste(){
    data3.forEach(e => insereTable3(e));
    let total3 = document.getElementById('total3');
    total3.innerHTML = data3.reduce((a, b) => a + parseInt(b.ch), 0);
    somaTotais();
}

function formAddAtv3() {
  clearModal3();
  document.getElementById("titleMotal3").innerHTML = 'Adicionar atividade';
  document.getElementById("addAtv3").innerHTML = "Adicionar";
  $('#modalAtv3').modal('show');
}

function clearModal3(){
  document.getElementById('tpProj3').value = '';
  document.getElementById('nome3').value = '';
  document.getElementById('funcao3').value = '';
  document.getElementById('orientandos3').value = '';
  document.getElementById('cargah3').value = '';
}

function formEditar3(id) {
  let idx3 = data3.findIndex(d =>d.id3 === id);
  let myObj = data3[idx3];
  document.getElementById("idx3").value = idx3;
  document.getElementById("id3").value  = myObj.id3;
  document.getElementById('tpProj3').value = myObj.tpProj3;
  document.getElementById('nome3').value = myObj.nome3;
  document.getElementById('funcao3').value =myObj.funcao3;
  document.getElementById('orientandos3').value = myObj.orientandos3;
  document.getElementById('cargah3').value = myObj.cargah3;

  document.getElementById("titleMotal3").innerHTML = 'Editar atividade';
  document.getElementById("addAtv3").innerHTML = "Alterar";

  $('#modalAtv3').modal('show');
}


function fecharModalAtv3() {
  clearModal3();
  $('#modalAtv3').modal('hide');
}

function addAtividade3(receiveData) {
  console.log(receiveData);
 // data = receiveData.data;
  data3.push(receiveData);
  insereTable3(receiveData);
  fecharModalAtv3();
}

function updateAtividade3(receiveData){
  data = receiveData.data;
  disciplinas[data.idx3] = {
    nome: data.nome,
    ch: data.ch,
    serie: data.serie,
    id: data.id
  };
  let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
  let linha = tabela.rows[data.idx];
  linha.cells[1].innerHTML = data.nome;
  linha.cells[2].innerHTML = data.ch;
  linha.cells[3].innerHTML = data.serie;
}

const frmAtv3 = document.getElementById('frmAtv3');
frmAtv3.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData(frmAtv3);
  const data = Object.fromEntries(formData);
  addAtividade3(data);
})