<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-6">
      <h3>Afastamento</h3>
      <?php 
         echo '<h5>' . $colegiado->nome . '  ' . $user['year_sel']  . '</h5>';
      ?>
    </div>
    <div class="col" style="text-align:left">
      <div><p hidden style="text-align: justify;   text-justify: inter-word;">
        O(A) professor(a) <?= $cargoAttri->nome_tt ?>, 
        como coordenador(a) do curso de <?= $cargoAttri->colegiado_tt ?> (
        <?= strtoupper($cargoAttri->codcam_tt) ?>/<?= $cargoAttri->codcentro_tt ?>), 
        atribuiu a ti a função de coordenador do(a) <strong><?= $cargoAttri->tipo ?></strong>. 
        Deverás atender os alunos do curso <strong><?= $cargoAttri->colegiado_tt ?></strong>, designando-os aos professores disponíveis e mais adequados para orientá-los.
        </p>
        <a class="card-link" href="../ajuda/?help=menu_orientar" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a>
      </div>
    </div>
  </div>
  <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <div style="max-height: 600px; overflow: scroll;">
        <table id="tabelaAtrib" name="tabelaAtrib" class="table table-bordered table-sm  table-hover">
          <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
            <tr>
              <th style="display: none;">ID</th>
              <th class="align-top" style="text-align: left; width: 400px;">Professor(a)</th>
              <th class="align-top" style="text-align: center; width: 30px;">PAD</th>
              
              <th class="align-top" style="text-align: left;" >Modalidade</th>
              <th class="align-top" >Tipo</th>
              <th class="align-top" >Portaria</th>
              <th class="align-top" style="text-align: center;" width="75px">CH</th>
              <th class="align-top" >Início</th>
               <th class="align-top" >Fim</th>

              <th class="align-top" style="text-align: center; width: 45px;"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv()">➕</button></th>
            </tr>
          </thead>
          <tbody>
            <?=$listaAfastados;?>
          </tbody>
        </table>
      </div>
    </div>
</div>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title" id="titleMotal">Adicionar afastamento</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body"  style="padding-top: 0px;">
            <span class="badge badge-light" id="titleMotalProf"></span>

<?php


  $ca_nome = $user['ca_nome']; // ['lota_nome']; 
  $co_nome = $user['co_nome'];
  include './includes/tblform.php';
?>
            
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
            <h4 class="modal-title" >Remover a orientação</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post">
              <div class="form-group">
              <div  id="msgApagar">Tem certeza que deseja remover a orientação do professor(a) para o aluno(a)?</div>
                <div class="justify-content-center mb-3 font-weight-bold" id="nomeRelacao">AAA</div>
                <input hidden name="idAtivDel" id="idAtivDel">
               
              </div>
    
              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="button" class="btn btn-danger btn-sm"  onclick="removVinc22()">Remover</button>
              </center>
    
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->



<script src="./includes/tblaAtt2.js"></script>
<script src="./includes/ccc.js"></script>
