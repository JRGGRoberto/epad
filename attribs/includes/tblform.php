   

<form class="form-group" id="frmfunoesatt" name="frmfunoesatt" method="post" action="includes/insert.php">
    <div class="form-group">
      <label for="listaFunc">Função</label>
      <select name="listaFunc" id="listaFunc" class="form-control" require="" onchange="ativaBTN();">
        <option value="-1">Selecione</option>
        <option value="a">Coordenação de Estágio</option>
        <option value="c">Coordenação de Trabalhos Acadêmicos</option>
        
      </select>

    </div>


    <div class="form-group" >
      <label for="listaProf">Função</label>
      <select name="listaProf" id="listaProf" class="form-control" require="" onchange="ativaBTN();">
          <option value="-1">Selecione</option>
          <?=$opcoes?>
      </select>
    </div>
    <input type="hidden" name="ano" value="<?=$ano?>">
    <input type="hidden" name="co" value="<?=$co?>">
    

    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" disabled>Adicionar</button>
    </center>
</form>

