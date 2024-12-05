<form class="form-group" id="frmAtv" name="frmAtv" method="post">
  <div class="row">
    <div class="form-group col-4" style="margin-bottom: 0;">
      <div class="form-group">
        <label for="listaFunc">Tipo de afastamento</label>
        <select name="listaFunc" id="listaFunc" class="form-control" require=""size="4">
          <option value="10">🏥 Médico</option>
          <option value="20">🎓 Doutorado</option>
          <option value="21">🎓 Mestrado</option>
          <option value="22">🎓 Pós-Doutorado</option>
        </select>
      </div>
    </div>
    <div class="form-group col-8"  style="margin-bottom: 0;">
      <div class="form-group" >
        <label for="vinculo">Professor(ª)</label>  
        <select name="vinculo" id="vinculo" class="form-control" require="" >
           <option >Selecione</option>
           <?= $listaProfs; ?>
        </select>
      </div>

    
      <div class="row">
        <div class="col">
          <div class="form-group" >
            <label for="tipo">Tipo de afastamento</label>  
            <div class="form-group row" >
              <div class="col-3">
                <input type="radio" name="tipo" value="p"> Parcial
              </div>
              <div class="col-3">
                <input type="radio" name="tipo" value="t"> Total
              </div>
            </div>
          </div>
        </div>
        <div class="col form-group">
           <label for="ch">Carga horária</label>
           <input type="number" name="ch"   id="ch" class="form-control" value="1" step="0.10" min="0.0" max="20">
        </div>
      </div>
    </div>

    
  </div>
<!--


-->
    

    
    <div class="form-group" >
      <label for="estudante">Portaria</label>
      <input type="text" name="estudante" id="estudante" class="form-control" maxlength="118" require>
    </div>
    
    <div class="row">
      <div class="form-group col-4">
        <label for="curso">Início</label>
        <input type="text" name="curso" id="curso" class="form-control" value="<?= $cargoAttri->colegiado_tt ?>" readonly>
      </div>

      <div class="form-group col-4">
        <label for="curso">Fim</label>
        <input type="text" name="curso" id="curso" class="form-control" value="<?= $cargoAttri->colegiado_tt ?>" readonly>
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
