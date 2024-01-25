<table id="tbl4" class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th style="display: none;">ID</th>
            <th class="align-top">Cargo</th>
            <th class="align-top">Local</th>
            <th class="align-top">Número e data Ato Legal</th>
            <th class="align-top" class="align-top" style="text-align: center;" width="140px" >Carga horária<br><sup>semanal</sup></th>
<?php if($editavel) { ?>
            <th class="align-top" style="width:90px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv4()">Adicionar</button></th>
<?php } ?>            
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
    
<?php 
   if($editavel) { 
      echo '<script src="./includes/atv4/tbla40.js"></script>';
   } else {
      echo '<script src="./includes/atv4/tbla40NC.js"></script>';
   }
?>

    