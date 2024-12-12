<form class="form-group" id="frmAddAfast" name="frmAddAfast" method="post" action="./includes/insert.php">
  <div class="row">
    <div class="form-group col-4" style="margin-bottom: 0;">
      <div class="form-group">
        <label for="modalidade">Tipo de afastamento</label>
        <select name="modalidade" id="modalidade" class="form-control" required size="4" onchange="chListaProfs()">
          <option value="10">🏥 Médico</option>
          <option value="20">🎓 Doutorado</option>
          <option value="21">🎓 Mestrado</option>
          <option value="22">🎓 Pós-Doutorado</option>
        </select>
      </div>
    </div>
    <div class="form-group col-8"  style="margin-bottom: 0;">
      <div class="form-group" >
        <label for="vinculo">Professor(ª) <sub>Se o professor não estiver na lista, remova a aprovação do PAD dele</sub></label>  
        <select name="vinculo" id="vinculo" class="form-control" required >
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
                <input type="radio" name="tipo" value="t" required onclick="setTotalCH()"> Total
                <input type="hidden" name="ano" value="<?= $anoQ;  ?> ">
              </div>
            </div>
          </div>
        </div>
        <div class="col form-group">
           <label for="chAfasta">Carga horária semanal</label>
           <input type="number" name="chAfasta"   id="chAfasta" class="form-control"  step="0.10" min="0.0" max="40" required>
        </div>
      </div>
    </div>

    
  </div>
<!--

-->
   
    <div class="form-group" >
      <label for="portaria">Portaria</label>
      <input type="text" name="portaria" id="portaria" class="form-control" maxlength="118" required>
    </div>
    
    <div class="row">
      <div class="form-group col-4">
        <label for="dt_inicio">Início</label>
        <input type="date" name="dt_inicio" id="dt_inicio" class="form-control" required>
      </div>

      <div class="form-group col-4">
        <label for="dt_fim">Fim</label>
        <input type="date" name="dt_fim" id="dt_fim" class="form-control" required>
      </div>

    </div>
    <div>
    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharFormAddAtv()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" >Adicionar</button>
    </center>
    </div>
    


  </form>
