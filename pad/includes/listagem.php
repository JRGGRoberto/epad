<section>



    <div class="card mt-2">
        <div class="card-header">
            <strong>1. DADOS DO DOCENTE</strong>
        </div>
        <div id="dadosDoc" class="collapse show" data-parent="#accordion" style="">
            <div class="card-body">
<?php
  include './includes/tbla10.php';
?>

            </div>
        </div>
    </div>



    <div id="accordion">

        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ21" aria-expanded="false"><strong>2.1. Atividades Didáticas</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Média semanal anual da carga horária didática:  <strong><span id="total2">0</span></strong></div>
                </div>
            </div>

            <div id="ativ21" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">

<?php
  include './includes/tbla21.php';
?>

                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ22" aria-expanded="false"><strong>2.2. Atividades de Supervisão e Orientação</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Média semanal anual da carga horária de orientação e supervisão: <strong> 0</strong></div>
                </div>
            </div>

            <div id="ativ22" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">
<?php
  include './includes/tbla22.php';
?>


                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ3" aria-expanded="false"><strong>3. ATIVIDADES DE PESQUISA / EXTENSÃO / CULTURA E PROGRAMAS ESPECIAIS</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Total de carga horária semanal PESQUISA/EXTENSÃO/CULTURA/PROGRAMAS ESPECIAIS: <strong><span id="total3">0</span></strong></div>
                </div>
            </div>

            <div id="ativ3" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">
<?php
  include './includes/tbla30.php';
?>


                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ4" aria-expanded="false"><strong>4. ATIVIDADES DE GESTÃO INSTITUCIONAL</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Total de carga horária semanal de gestão institucional: <strong> 0</strong></div>
                </div>
            </div>

            <div id="ativ4" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">

<?php
  include './includes/tbla40.php';
?>

                </div>
            </div>
        </div>

    </div>


    <div class="card mt-2">
        <div class="card-header">
            <strong>5. RESUMO DAS ATIVIDES E TOTALIZAÇÃO</strong>
        </div>
        <div id="resumo" class="collapse show" data-parent="#accordion" style="">
            <div class="card-body">
                <table class="table table-bordered table-sm">

                    <tr>
                        <th>1</th>
                        <th>Total de média semanal anual de carga horária didática</th>
                        <td>0h</td>
                    <tr>
                        <th>2</th>
                        <th>Total de média semanal anual de carga horária supervisão e orientação</th>
                        <td>0h</td>
                    <tr>
                        <th>3</th>
                        <th>Total de carga horária semanal pesquisa/extensão/cultura/programas especiais</th>
                        <td>0h</td>
                    <tr>
                        <th>4</th>
                        <th>Total de carga horária semanal de gestão institucional</th>
                        <td>0h</td>
                    </tr>

                    <tr>
                        <th>4</th>
                        <th>Total de carga horária semanal de gestão institucional</th>
                        <td>0h</td>
                    </tr>

                    <tr>
                        <th colspan="2">Total de carga horária semanal</th>
                        <td>0h</td>
                    </tr>


                </table>

            </div>
        </div>
    </div>


    <div class="card mt-2">
        <div class="card-header">
            <strong>6. OUTRAS OBSERVAÇÕES</strong>
        </div>
        <div id="resumo" class="collapse show" data-parent="#accordion" style="">
            <div class="card-body">
                <input type="text" name="" id="">
            </div>
        </div>
    </div>




</section>




<!-- The Modal -->
<div class="modal fade" id="modalSub">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modalTitle">Título</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="modalBody">
          

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" id="modalFooter">
          
        </div>
        
      </div>
    </div>
  </div>
  <!-- The Modal -->