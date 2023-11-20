<div class="container mt-3">
    <h1>Matrizes de Cursos</h1>
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
            <th>Carga horária</th>
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
echo " <script> getDBMD('". $user['co_id'] ."') </script>";
?>








