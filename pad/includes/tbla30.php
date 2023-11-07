<table id="tbl3" class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th style="display: none;">ID</th>
            <th>ATIVIDADES DE PESQUISA, EXTENSÃO E CULTURA E PROGRAMAS ESPECIAIS </th>
            <th>FUNÇÃO</th>
            <th>NOME DO ORIENTANDO (se houver)</th>
            <th>Carga horária semanal</th>
            <th style="width:20px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv3()">Adicionar</button></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


    <!-- The Modal ADD / EDT-->
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
                    <input type="hidden" name="id_matriz" id="id_matriz" value="<?= $matriz->id ?>">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idx" id ="idx">
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
    <!--  The Modal ADD / EDT Fim-->






    <!-- The Modal DELET-->
    <div class="modal fade" id="modalDel">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" >Remover atividade</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDiscDel" name="frmDiscDel" method="post">
              <div class="form-group">
                Tem certeza que deseja apagar a disciplina abaixo? 
                <div class="d-flex justify-content-center mb-3" id="nomeDisDel"></div>
                <input type="hidden" name="id_disDel" id="id_disDel">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm" >Apagar</button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->


<script>

let data3 = [
    {
        'id': '1',
        'atividade': 'Projeto de Pesquisa: Estudos sobre recursos tecnológicos digitais e seus usos por professores em suas práticas profissionais e em seus processos formativos',
        'funcao': 'Coordenador',
        'orientando': 'Débora Rengel, Noeli Teresinha Valério de Almeida, Suzana Pereira do Prado, Suely Maria de Souza',
        'ch': '8'
    },
    {
        'id': '2',
        'atividade': 'Projeto de Pesquisa: Estudos sobre recursos tecnológicos',
        'funcao': 'Coordenador',
        'orientando': 'Joãozinho',
        'ch': '2'
    }
 ];

function insereTable3(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tbl3").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();
    let celId         = newLinha.insertCell(0);
    let celAtiv       = newLinha.insertCell(1);
    let celFunc       = newLinha.insertCell(2);
    let celNomeOrient = newLinha.insertCell(3);
    let celCH         = newLinha.insertCell(4);
    let celDelet      = newLinha.insertCell(5);

  celId.innerHTML         = newDisc.id;
  celAtiv.innerHTML       = newDisc.atividade;
  celFunc.innerHTML       = newDisc.funcao;
  celNomeOrient.innerHTML = newDisc.orientando;
  celCH.innerHTML         = newDisc.ch;
  celDelet.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow3('${newDisc.id}')">⛔</button>
    <button type="button" class="btn btn-light btn-sm" onclick="formEditar3('${newDisc.id}')">✏️</button>
  </center>`;

  celId.style.display = 'none'; 
}

function formAddAtv3(){
    data3.forEach(e => insereTable(e));
    let total3 = document.getElementById('total3');
    total3.innerHTML = data3.reduce((a, b) => a + parseInt(b.ch), 0);
}


</script>