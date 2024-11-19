<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-7">
      <h3>Ver o que coloca aqui</h3><sup><?=$subTitle?> - Lista de professores do colegiado de <strong><?=  $nomeCurso .' ['. $anoCurso  .'] '?></strong></sup>
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
            <th class="align-top" style="text-align: center; width: 35px; padding: 15px 5px;">Professor(ª)</th>
            <!-- Diminuir a largura da coluna PAD -->
            <th class="align-top" style="text-align: center; width: 50px; padding: 15px 5px;">PAD</th> <!-- Reduzi para 50px -->
            <th class="align-top" style="text-align: center; width: 90px; padding: 15px 5px;">Observações</th>
            <!-- Diminuir a largura da coluna "🖊️" -->
            <th class="align-top" style="text-align: center; width: 40px; padding: 15px 5px;">🖊️</th> <!-- Reduzi para 40px -->
            <th style="display: none;">🖊️</th>
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
            <textarea class="form-control" id="observacaoText" name="observacaoText" rows="4"></textarea>
            <input type="hidden" name="vinc_idps" id="vinc_idps">
          </div>
          <center>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="adicionarObservacao()">Adicionar Observação</button>
          </center>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="./includes/tblasco.js"></script>
