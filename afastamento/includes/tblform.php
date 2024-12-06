<form class="form-group" id="frmAtv" name="frmAtv" method="post">
  <div class="row">
    <div class="form-group col-4" style="margin-bottom: 0;">
      <div class="form-group">
        <label for="listaFunc">Tipo de afastamento</label>
        <select name="listaFunc" id="listaFunc" class="form-control" required size="4">
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
        <select name="vinculo" id="vinculo" class="form-control" required >
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
                <input type="radio" name="tipo" value="p" required > Parcial
              </div>
              <div class="col-3">
                <input type="radio" name="tipo" value="t" required> Total
              </div>
            </div>
          </div>
        </div>
        <div class="col form-group">
           <label for="chAfasta">Carga horária</label>
           <input type="number" name="chAfasta"   id="chAfasta" class="form-control"  step="0.10" min="0.0" max="40" required>
        </div>
      </div>
    </div>

    
  </div>
<!--


-->
   
    <div class="form-group" >
      <label for="portaria">Portaria</label>
      <input type="text" name="portaria" id="portaria" class="form-control" maxlength="118" require>
    </div>
    
    <div class="row">
      <div class="form-group col-4">
        <label for="dt_inicio">Início</label>
        <input type="date" name="dt_inicio" id="dt_inicio" class="form-control" >
      </div>

      <div class="form-group col-4">
        <label for="dt_fim">Fim</label>
        <input type="date" name="dt_fim" id="dt_fim" class="form-control" >
      </div>

    </div>
    <div>
    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharFormAddAtv()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" >Adicionar</button>
    </center>
    </div>
    


  </form>
