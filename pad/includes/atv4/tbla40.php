<table id="tbl4" class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th style="display: none;">ID</th>
            <th>Cargo</th>
            <th>Local</th>
            <th>Número de data Ato Legal</th>
            <th>Turno</th>
            <th class="align-top">Carga horária<br><sup>semanal</sup></th>
            <th style="width:20px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddEquipe()">Adicionar</button></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv4">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMotal4">TITULO</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">

<?php
  include './includes/atv4/tbla40form.php';
?>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->

    <script src="./includes/atv4/tbla40.js"></script>