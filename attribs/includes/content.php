<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-2"><h3>Atribuições</h3></div>
    <div class="col" style="text-align:left">
      <div>
        <span class="badge badge-pill badge-light">2.2. Atividades de Supervisão e Orientação</span>
      </div>
      <div>
        <span style="text-align: right; background-color: #ffeeba; border-block-color: #ffdf7e; padding: 5px; font-size:12px;">Faltando horas</span>
        <span style="text-align: right; background-color: #c3e6cb; border-block-color: #8fd19e; padding: 5px; font-size:12px;">Ok horas completas</span>
        <span style="text-align: right; background-color: #f5c6cb; border-block-color: #ed969e; padding: 5px; font-size:12px;">Extrapolou as horas do RT</span>
      </div>
    </div>
          
  </div>
  <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <div style="max-height: 600px; overflow: scroll;">
        <table id="tabelaPADS" name="tabelaPADS" class="table table-bordered table-sm  table-hover">
          <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
            <tr>
              <th style="display: none;">ID</th>
              <th class="align-top">Professor(ª)</th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.1</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.2</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 3</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 4</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Total att</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">RT</th>
              <th class="align-top" style="text-align: center; width: 45px;" >⚙️</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <sub style="line-height: 12px;">
      <strong>Ativ. 2.1</strong>) Total de média semanal anual de carga horária didática; 
      <strong>Ativ. 2.2</strong>) Total de média semanal anual de carga horária supervisão e orientação; 
      <strong>Ativ. 3</strong>) Total de carga horária semanal pesquisa/extensão/cultura/programas especiais; 
      <strong>Ativ. 4</strong>)	Total de carga horária semanal de gestão institucional; 
      <strong>Total att</strong>) Total de carga horária semanal; 
      <strong>RT</strong>) Regime de trabalho.</sub>
    </div>
</div>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title" id="titleMotal">2.2. Atividades de Supervisão e Orientação</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body"  style="padding-top: 0px;">
            <span class="badge badge-light" id="titleMotalProf"></span>

<?php
  include './includes/tblform.php';
?>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->

<script src="./includes/tbla22.js"></script>


