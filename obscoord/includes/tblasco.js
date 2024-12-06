let data = [];
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

  const data = {
    vinc_idps: vinc_idps,
    observacao: observacaoText
  };

  fetch('./dml/adicionarObservacao.php', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
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
  data = [];
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
  let idX = data.findIndex(e => e.id === id);
  document.getElementById('vinc_idps').value = id; // Define o ID no campo correspondente
  document.getElementById('observacaoText').value = data[idX].obscoord;// ""; // Limpa o campo de observação
}


async function getDBMD() {
  deleteAllRows();
  data = await fetch(`../api/padsobs.php?md=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  
  if (data.length > 0) {
    data.forEach(e => insereTable(e));
  } 
}

getDBMD();
