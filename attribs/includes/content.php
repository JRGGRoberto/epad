<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-2">
        <h3 style="margin-bottom: 0;">Atribuições</h3>
        <span class="badge badge-pill badge-light">Estágio / Trab. Acadêmicos</span>

    </div>
    <div class="col" style="text-align:left">
      <div>
        <span class="badge badge-pill badge-light"><?=  $nomeCurso .' ['. $anoCurso  .'] '?></span><br>
        <span class="badge badge-pill badge-light">Professores que irão gerir as funções</span>
        <a class="card-link" href="../ajuda/?help=coord_atrib" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a>
      </div>
      <div>

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
              <th class="align-top">Professor(ª)</th>
              <th class="align-top">Função</th>
              <th class="align-top" style="text-align: center; width: 45px;"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv()">➕</button></th>
            </tr>
          </thead>
          <tbody>
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
              <h4 class="modal-title" id="titleMotal">Atribuição de funções</h4>
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
            <h4 class="modal-title" >Remoção de atribuição</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post">
              <div class="form-group">
              <div  id="msgApagar">Tem certeza que deseja remover a atribuição abaixo?</div>
                <div class="d-flex justify-content-center mb-3 font-weight-bold" id="nomeRelacao">AAA</div>
                <input hidden name="idAtivDel" id="idAtivDel">
               
              </div>
    
              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="button" class="btn btn-danger btn-sm"  onclick="removCargo()">Remover</button>
              </center>
    
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->




<script src="./includes/tblac.js"></script>
<script src="./includes/ccc.js"></script>


