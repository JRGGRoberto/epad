<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-6">
      <h3>Observações do coodenador no PAD do professor(ª)</h3><sup><?=$subTitle?> - Lista de professores do colegiado de <strong><?=  $nomeCurso .' ['. $anoCurso  .'] '?></strong></sup>
    </div>
    <div class="col-6">
     <span style="font-weight: 400; font-size: 70%">
       <ul>
          <li>Clique em 🖊️ na tupla do professor para adicionar uma observação.</li>
          <li>Ela não pode ser editada, se quiser manter copie o texto e cole-lo no na parte de edição, pois ela irá se sobrepor.</li>
          <li>As informações ficaram na segunda parte do item <strong>6</strong> do PAD do professor</li>
       </ul> 
       </span>
    </div>
  </div>
  <hr>
  <!-- TABLE -->
  <div class="form-group table-responsive-sm">
    <div style="max-height: 600px; overflow: auto;">
      <table id="tabelaOBSProfs" name="tabelaOBSProfs" class="table table-bordered table-sm table-hover">
        <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
          <tr>
            <th style="display: none;">ID</th>
            <th class="align-top" style="text-align: left; width: 350px; ">Professor(ª)</th>
            <!-- Diminuir a largura da coluna PAD -->
            <th class="align-top" style="text-align: center; width: 15px; ">PAD</th> <!-- Reduzi para 50px -->
            <th class="align-top" style="text-align: center; width: 650px; ">Observações</th>
            <!-- Diminuir a largura da coluna "🖊️" -->
            <th class="align-top" style="text-align: center; width: 15px; ">🖊️</th> <!-- Reduzi para 40px -->
            
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal para adicionar Observações -->
<div class="modal fade" id="modalOBS">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Observações para PAD</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form class="form-group" id="frmObs" name="frmObs" method="post">
          <div class="form-group">
            <label for="observacaoText">Digite a observação:</label>
            <textarea 
              class="form-control" 
              id="observacaoText" 
              name="observacaoText" 
              rows="4" 
              placeholder="Digite as observações..." 
              >
            </textarea>
            <input type="hidden" name="vinc_idps" id="vinc_idps">
          </div>
          <center>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="adicionarObservacao()">Adicionar Observação</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="removerObservacao()">Remover Observação</button>
          </center>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="./includes/tblasco.js"></script>
