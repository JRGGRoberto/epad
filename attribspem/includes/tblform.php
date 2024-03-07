<form class="form-group" id="frmAtv" name="frmAtv" method="post">
    <div class="form-group">
      <label for="listaFunc">Atividade</label>
      <select name="atividade" id="atividade" class="form-control" required>
         <option value="1">Projeto de ensino</option>
         <option value="1">Monitoria</option>
      </select>

    </div>
    
    <div class="form-group row">
      <div class="col-3">
        <div class="form-group">
          <label for="ca">Campus</label>
          <select name="id_campus" id="ca" class="form-control" required>
          </select>
        </div> 
      </div>

      <div class="col-2">
        <div class="form-group">
          <label for="ce">Centro</label>
          <select name="id_centro"  id="ce" class="form-control" required>
          </select>
        </div> 
      </div>

      <div class="col-7">
        <div class="form-group">
          <label for="co">Colegiado</label>
          <select name="id_colegiado" id="co" class="form-control" required>
          </select>
        </div> 
      </div>
    </div>

    <div class="form-group" >
      <label for="vinculo">Professor(ª)</label>  
      <select name="vinculo" id="vinculo" class="form-control" require="" onchange="ativaBTN();" >
      </select>
    </div>

    <div class="row">
    
      <div class="form-group  col" >
        <label for="estudante">Nome do projeto de ensino ou curso</label>
        <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" maxlength="118" require>
      </div>
  
      <div class="form-group col-2">
        <label for="ch">Carga horária</label>
        <input type="number" name="ch"   id="ch" class="form-control" value="1" step="0.10" min="0.0" max="20">
      </div>

    </div>
    
    <input type="hidden" name="id"        id="id"><br>
    <input type="hidden" name="id_co"     id="id_co"     value="<?=$cargoAttri->co_id_tt?>"><br>


    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharFormAddAtv()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" >Adicionar</button>
    </center>
</form>

