<form class="form-group" id="frmAtv22" name="frmAtv22" method="post" >
    <div class="form-group">
      <label for="tpAtiv22">Atividade</label>
      <input type="hidden" name="id22" id="id22">
      <input type="hidden" name="idx22" id="idx22">
      <input type="hidden" name="vinc22" id="vinc22">
      <select name="tpAtiv22" id="tpAtiv22" class="form-control" require="">
        <?= $option1 ?>
      </select>
    </div>


    <div class="form-group" >
      <label for="nome22F">Nome do(a) estudante</label>
      <input type="text" name="nome22F" id="nome22F" class="form-control">
    </div>
    
    <div class="row">
      <div class="form-group col-8">
        <label for="curso22F">Curso</label>
        <input type="text" name="curso22F" id="curso22F" class="form-control">
      </div>
  
      <div class="form-group col">
        <label for="serie22F">Série</label>
        <input type="number" name="serie22F" pattern="[0-9]+$"  id="serie22F" class="form-control">
      </div>
    </div>

    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="btnFecharCanc()">Fechar</button>
      <button type="submit" id="addEdt22" class="btn btn-primary btn-sm" >Adicionar</button>
    </center>
</form>


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
        <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post">
          <div class="form-group">
          <div  id="msgApagar">Tem certeza que deseja apagar a atividade relacionada ao aluno(ª) abaixo?</div>
            <div class="d-flex justify-content-center mb-3 font-weight-bold" id="nomeAtivDel">AAA</div>
            <input hidden name="idAtivDel" id="idAtivDel">
           
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

