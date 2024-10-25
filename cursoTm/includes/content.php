<div class="container mt-3">
    <div class="row">
      <div class="col-11"><h3>Selecione qual a matriz para alteração de disciplina</h3></div>
      <div class="col" style="text-align:right"><!--<a href="../curso/">voltar</a> --> <a class="card-link" href="../ajuda/?help=coord_aulas" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a></div>
    </div>
    <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <table id="tabelaMatD" class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="display: none;">ID</th>
            <th>Ano</th>
            <th>Curso</th>
            <th>Nome</th>
            <th>Período</th>
            <th>Preenchimento</th>
            <th style="text-align: center;"><button type="button" class="btn btn-warning" disabled=""></button></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
<script src="./ccc1.js"></script>
<?php
echo " <script> getDBMD('". $user['co_id'] . ''. $user['AnoAtivo'] . "') </script>";
?>








