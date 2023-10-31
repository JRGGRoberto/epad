<div class="container mt-3">
    <h1>Matrize de Disciplinas</h1>

    <hr>

    <div class="row">
      <div class="col-2">
        <div class="form-group">
          <label for="ca">Campus</label>
          <select name="id_campus" id="ca" class="form-control" readonly>
            <option value=""><?= $inf->campus ?></option>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="ce">Centro</label>
          <select name="id_centro" id="ce" class="form-control" readonly>
            <option value=""><?= $inf->centros ?></option>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="co">Curso</label>
          <select name="id_colegiado" id="co" class="form-control" readonly>
            <option value=""><?= $inf->colegiado ?></option>
          </select>
        </div>
      </div>
    </div>


    <div class="form-group">  
                  <div class="row">
                    <div class="form-group col">
                      Ano letivo: <?= $disc->ano ?>
                    </div>

                    <div class="form-group col">
                      Carga horária: <?= $disc->ch ?>
                    </div>

                    <div class="form-group col">
                      Vagas: <?= $disc->vagas ?>
                    </div>
                    
                  </div>
    
                  <div class="row">
                    <div class="form-group col">
                      Habilitação: <?= $habil ?>
                    </div>

                    <div class="form-group col-5">
                      Regime de oferta: <?= $oferta ?>
                    </div>

                    <div class="form-group col">
                      Período de funcionamento: <?= $turno ?>
                    </div>

                  </div>
              </div>

    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <table id="tabelaMatD" name="tabelaMatD" class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="display: none;">ID</th>
            <th>Disciplina</th>
            <th>Carga horária</th>
            <th>Série</th>
            <th style="text-align: center;"><button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" id="btnAdicionarD">Adicionar</button></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalDis">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMemb">TITULO</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDisc" name="frmDisc" method="post">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="disc">Nome da disciplina</label>
                    <input type="text" class="form-control" id="disc" name="disc" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="ch">Carga horária</label>
                    <input type="text" class="form-control" id="ch" name="ch" >
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="serie">Série</label>
                    <input type="text" class="form-control" id="serie" name="serie" >
                  </div>
                </div>
              </div>
              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDis()">Fechar</button>
                <button type="submit" id="addMatrDis" class="btn btn-primary btn-sm" ></button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal Fim-->


<script>

let disciplinas = [ ];

function formAddDis() {
  clearModal();
  document.getElementById("titleMemb").innerHTML = 'Adicionar disciplina';
  $('#modalDis').modal('show');
  document.getElementById("addMatrDis").innerHTML = "Adicionar";
}

function clearModal() {
  document.getElementById("disc").value = '';
  document.getElementById("ch").value = '';
  document.getElementById("serie").value = '';
}

function fecharModalDis() {
  $('#modalDis').modal('hide');
}


function insereTable(newDisc){
    // Adicionar uma nova linha na tabela
    let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];
    let newLinha = tabela.insertRow();
      let celDisc  = newLinha.insertCell(0);
      let celCh    = newLinha.insertCell(1);
      let celSerie = newLinha.insertCell(2);

      celDisc.innerHTML = newDisc.disc;
      celCh.innerHTML = newDisc.ch;
      celSerie.innerHTML = newDisc.serie;
    
    celDelete.innerHTML = '<center><button type="button" class="btn btn-light btn-sm" onclick="excluirContato(' + novoContato.id + ')">⛔</button><button type="button" class="btn btn-light btn-sm" onclick="formEditarMembro(' + novoContato.id + ')">✏️</button></center></center>';
  }

  function adicionarContato() {
    // Adicionar o novo contato no array
    equipe.push(novoContato);
       
    //Call preenche <Table>
    insereTable(novoContato);
            
    // Limpar os inputs
    clearModalEquipe();
    fecharModalDis();
  }
  


const formM = document.getElementById('frmDisc');

    formM.addEventListener('submit', e => {
        e.preventDefault();

        const formData = new FormData(formM);
        const data = Object.fromEntries(formData);
// ../matrizes/add/index.php
        fetch('./add/index.php', {
            method:'POST',
            headers:{
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json()).then(data => console.log(data))
    });

</script>