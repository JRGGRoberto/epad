<table id="tbl3" class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th style="display: none;">ID</th>
            <th class="align-top">Atividades de Pesquisa,<br>Extensão e Cultura e Programas Especiais</th>
            <th class="align-top" style="text-align: center;">Função</th>
            <th class="align-top">Nome do orientando<br><sup>(se houver)</sup></th>
            <th class="align-top" style="text-align: center;">Carga horária<br><sup>semanal</sup></th>
<?php if($editavel) { ?>
            <th class="align-top" style="width:90px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv3()">Adicionar</button></th>
<?php } ?>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv3">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMotal3">TITULO</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">

<?php

  include './includes/atv3/tbla30form.php';

?>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->

    
    <?php 
   if($editavel) { 
      echo '<script src="./includes/atv3/tbla30.js"></script>';
   } else {
      echo '<script src="./includes/atv3/tbla30NC.js"></script>';
   }
?>