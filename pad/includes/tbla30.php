<table id="tbl3" class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th style="display: none;">ID</th>
            <th>Atividades de Pesquisa, Extensão e Cultura e Programas Especiais</th>
            <th>Função</th>
            <th>Nome do orientando (se houver)</th>
            <th>Carga horária semanal</th>
            <th style="width:20px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv3()">Adicionar</button></th>
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
  include './includes/tbla30form.php';
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
            <h4 class="modal-title" >Remover atividade</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDiscDel" name="frmDiscDel" method="post">
              <div class="form-group">
                Tem certeza que deseja apagar a disciplina abaixo? 
                <div class="d-flex justify-content-center mb-3" id="nomeDisDel"></div>
                <input type="hidden" name="id_disDel" id="id_disDel">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm" >Apagar</button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->

    <script src="./includes/tbla30.js"></script>