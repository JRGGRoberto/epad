<form class="form-group" id="frmAtv" name="frmAtv" method="post">
    <div class="form-group">
      <label for="listaFunc">Função</label>
      <select name="listaFunc" id="listaFunc" class="form-control" require="" readonly>
         <?= $funcSelected ?>
      </select>

    </div>

    <div class="form-group" >
      <label for="filtro">Filtro para localizar um professor para orientação</label>
      <select name="filtro" id="filtro"  class="form-control" onchange="execFiltro(this.value)">
        <option value="1">Meu colegiado</option>
        <option value="2">Meu campus</option>
        <option value="3">Todos</option>
      </select>
    </div>

    <div class="form-group" >
      <label for="vinculo">Definir que o professor(a) orientador(a)</label>  
      <select name="vinculo" id="vinculo" class="form-control" require >
          <option>Selecione</option>
          <?=$opcoes?>
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

<script>
  function execFiltro(a){
    switch(a) {
      case '1': // Meu colegiado
        somenteMeColegiado('<?= $co_nome ?>');
        showSoMeuCampus('<?= $ca_nome ?>');
        break;
      case '2': // Meu campus
        showAllColegiado();
        showSoMeuCampus('<?= $ca_nome ?>');
        break;
      case '3':  // Todos
        showAllColegiado();
        showAllCampi();
        break;
       }
  }


function showSoMeuCampus(camp) {
  let allOptgroups = document.querySelectorAll('optgroup');
  let optgroupToDisplay = document.querySelector('optgroup[label="'+ camp+ '"]');
  allOptgroups.forEach(optgroup => {
      if (optgroup !== optgroupToDisplay) {
        optgroup.setAttribute('hidden', true);
      }
    });
  
 }

 function showAllCampi() {
    let allOptgroups = document.querySelectorAll('optgroup');
    allOptgroups.forEach(optgroup => {
       optgroup.removeAttribute('hidden');
     });
  }

  function somenteMeColegiado(filtro) {
    var select = document.getElementById("vinculo");
    var options = select.getElementsByTagName("option");
    for (var i = 0; i < options.length; i++) {
      var optionText = options[i].textContent.toLowerCase();
      if (optionText.includes(filtro.toLowerCase())) {
      //  options[i].style.display = "";
         options[i].removeAttribute('hidden');
      } else {
      //  options[i].style.display = "none";
        options[i].setAttribute('hidden', true);
      }
    }
  }

  function showAllColegiado(){
    var select = document.getElementById("vinculo");
    var options = select.getElementsByTagName("option");
    for (var i = 0; i < options.length; i++) {
     // options[i].style.display = "";
       options[i].removeAttribute('hidden');
    }
  }

</script>