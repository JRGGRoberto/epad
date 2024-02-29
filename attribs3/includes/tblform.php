<form class="form-group" id="frmAtv" name="frmAtv" method="post">
    <div class="form-group">
      <label for="listaFunc">Função</label>
      <select name="listaFunc" id="listaFunc" class="form-control" require="" readonly>
         <?= $funcSelected ?>
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

    
    <div class="form-group" >
      <label for="estudante">A orientar o trabalho do(a) aluno(a)</label>
      <input type="text" name="estudante" id="estudante" class="form-control" require>
    </div>
    
    <div class="row">
      <div class="form-group col-8">
        <label for="curso">Aluno(a) do curso de</label>
        <input type="text" name="curso" id="curso" class="form-control" value="<?= $cargoAttri->colegiado_tt ?>" readonly>
      </div>
  
      <div class="form-group col">
        <label for="serie">Série</label>
        <select name="serie" id="serie" class="form-control" require>
          <option >Selecione</option>
          <option value="1">1ª Série</option>
          <option value="2">2ª Série</option>
          <option value="3">3ª Série</option>
          <option value="4">4ª Série</option>
        </select>
      </div>

      <div class="form-group col">
        <label for="ch">Carga horária</label>
        <input type="number" name="ch" pattern="[0-9]+$"  id="ch" class="form-control">
      </div>
    </div>
    
    <input type="hidden" name="id"        id="id"><br>
    <input type="hidden" name="id_co"     id="id_co"     value="<?=$cargoAttri->co_id_tt?>"><br>
    <input type="hidden" name="atividade" id="atividade" value="<?=$cargoAttri->tipocod?>">

    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharFormAddAtv()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" >Adicionar</button>
    </center>
</form>

