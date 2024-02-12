<form class="form-group" id="frmfunoesatt" name="frmfunoesatt" method="post" action="includes/insert.php">
    <div class="form-group">
      <label for="listaFunc">Função</label>
      <select name="listaFunc" id="listaFunc" class="form-control" require="" onchange="ativaBTN();">
        <option value="-1">Selecione</option>
        <option value="a">Coordenar o aluno(a) no Estágio</option>
        <option value="c">Coordenar o aluno(a) nos Trabalhos Acadêmicos</option>
        
      </select>

    </div>

    <div class="form-group" >
      <label for="filtro">Filtro para localizar um professor</label>
      <select name="filtro" id="filtro"  class="form-control" onchange="execFiltro(this.value)">
        <option value="1">Meu colegiado</option>
        <option value="2">Meu campus</option>
        <option value="3">Todos</option>
      </select>
    </div>

    <div class="form-group" >
      <label for="listaProf">Definir que o professor(ª)</label>  
      <select name="listaProf" id="listaProf" class="form-control" require="" onchange="ativaBTN();" >
          <option value="-1">Selecione</option>
          <?=$opcoes?>
      </select>
    </div>
    
    <div class="form-group" >
      <label for="nome22F">Oriente o trabalho do(a) aluno(a)</label>
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
    


    <input type="hidden" name="ano" value="<?=$ano?>">
    <input type="hidden" name="co" value="<?=$co?>">
    

    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
      <button type="submit" id="addBtnF" class="btn btn-primary btn-sm" disabled>Adicionar</button>
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
    var select = document.getElementById("listaProf");
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
    var select = document.getElementById("listaProf");
    var options = select.getElementsByTagName("option");
    for (var i = 0; i < options.length; i++) {
     // options[i].style.display = "";
       options[i].removeAttribute('hidden');
    }
  }


</script>