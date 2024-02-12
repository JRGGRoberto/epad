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
      <label for="filtro">Filtro</label>
      <select name="filtro" id="filtro"  class="form-control" onchange="execFiltro(this.value)">
        <option value="1">Meu colegiado</option>
        <option value="2">Meu campus</option>
        <option value="3">Todos</option>
      </select>
    </div>

    <div class="form-group" >
      <label for="listaProf">Professor(ª)</label>  
      <select name="listaProf" id="listaProf" class="form-control" require="" onchange="ativaBTN();" >
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