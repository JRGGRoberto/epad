let datas = [];
const icon = ["❌🖋️",  "📄🖋️"];

// Função para adicionar uma nova observação
function adicionarObservacao() {
  const observacaoText = document.getElementById('observacaoText').value;
  const vinc_idps = document.getElementById('vinc_idps').value;

  // Validação de campo
  if (!observacaoText) {
    alert("Por favor, insira uma observação.");
    return;
  }

  const dataObs = {
    vinc_idps: vinc_idps,
    observacao: observacaoText
  };

  fetch('./dml/editarObservacao.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(dataObs)
  })
  .then(res => res.json())
  .then(response => {
    // alert(response.message);
    getDBMD();  // Atualizar a tabela após adicionar a observação
    $('#modalOBS').modal('hide');
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

// Função para remover uma observação
function removerObservacao() {
  const observacaoText = null;
  const vinc_idps = document.getElementById('vinc_idps').value;

  const dataObs = {
    vinc_idps: vinc_idps,
    observacao: observacaoText
  };

  fetch('./dml/editarObservacao.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(dataObs)
  })
  .then(res => res.json())
  .then(response => {
    // alert(response.message);
    getDBMD();  // Atualizar a tabela após adicionar a observação
    $('#modalOBS').modal('hide');
  })
  .catch(error => {
    console.error('Error:', error);
  });
}


function deleteAllRows(){
  datas = [];
  $("#tabelaOBSProfs tbody tr").remove(); 
}

function insereTable(newDisc) {
  let tabela = document.getElementById("tabelaOBSProfs").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

  let celNome = newLinha.insertCell(0);
  let celLink = newLinha.insertCell(1);
  let celResumo = newLinha.insertCell(2);
  let celBtn = newLinha.insertCell(3);

  celNome.innerHTML = newDisc.nome;
  celLink.innerHTML = `<a href="../padstoprn/index.php?id=${newDisc.id}" target="_blank" style="display: block; text-align: center;">📄</a>`;
  if (newDisc.obscoord === null) {
    celResumo.innerHTML = "sem observação";
  } else {
    celResumo.innerHTML = newDisc.obscoord;
  }
  celBtn.innerHTML = `<button type="button" class="btn btn-light btn-sm" onclick="openModalObservacao('${newDisc.id}')" style="display: block; margin: 0 auto;">🖊️</button>`;
  

}

function openModalObservacao(id) {
  $('#modalOBS').modal('show'); // Exibe o modal
  let idX = datas.findIndex(e => e.id === id);
  document.getElementById('vinc_idps').value = id; // Define o ID no campo correspondente
  document.getElementById('observacaoText').value = datas[idX].obscoord;
}


async function getDBMD() {
  deleteAllRows();
  datas = await fetch(`../api/padsobs.php?md=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  
  if (datas.length > 0) {
    datas.forEach(e => insereTable(e));
  } 
}

 getDBMD();