<div class="container mt-3">
    <h3>Atribuições</h3>

    <hr>
    <h5>Coordenador de estágio</h5>
    <div class="row">
      <div class="form-group col-5">
          <select name="selCoordEstagio"  id="selCoordEstagio" class="form-control" onchange="chEstagio();">
            <option value="">Selecione</option>
            <?=$selOptionEstagio?>
          </select>
      </div>
      <div class="col">
        <input id="btnEstagio" type="button" value="Alterar" class="btn btn-primary btn-sm" onclick="updEstagio();" hidden>
      </div>
    </div>



    <hr>
    <h5>Coordenador de TCC</h5>
    <div class="row">
      <div class="form-group col-5">
          <select name="selCoordTCC" id="selCoordTCC" class="form-control" onchange="chTCC();">
            <option value="">Selecione</option>
            <?=$selOptionEstagio?>
          </select>
      </div>
      <div class="col">
        <input id="btnTCC" type="button" value="Alterar" class="btn btn-primary btn-sm" onclick="updTCC();" hidden>
      </div>
    </div>
 
    <hr>
    <h5>Coordenador de ACEC</h5>
    <div class="row">
      <div class="form-group col-5">
          <select name="selCoordACEC"  id="selCoordACEC" class="form-control" onchange="chACEC();" >
            <option value="">Selecione</option>
            <?=$selOptionEstagio?>
          </select>
      </div>
      <div class="col">
        <input id="btnACEC" type="button" value="Alterar" class="btn btn-primary btn-sm" onclick="updACEC();" hidden>
      </div>
    </div>


</div>


<script>

let valInitACEC = document.getElementById('selCoordACEC').value;
let btnACEC = document.getElementById('btnACEC');

function chACEC(){
  const valAtual = document.getElementById('selCoordACEC').value;
  if (valAtual === valInitACEC){
    btnACEC.hidden = true;
  } else {
    btnACEC.hidden = false;
  }
}

function updACEC(){
  const valAtual = document.getElementById('selCoordACEC').value;
  valInitACEC = valAtual;
  btnACEC.hidden = true;
}



let valInitTCC = document.getElementById('selCoordTCC').value;
let btnTCC = document.getElementById('btnTCC');

function chTCC(){
  const valAtual = document.getElementById('selCoordTCC').value;
  if (valAtual === valInitTCC){
    btnTCC.hidden = true;
  } else {
    btnTCC.hidden = false;
  }
}

function updTCC(){
  const valAtual = document.getElementById('selCoordTCC').value;
  valInitTCC = valAtual;
  btnTCC.hidden = true;
}

  
let valInitEstagio = document.getElementById('selCoordEstagio').value;
let btnEstagio = document.getElementById('btnEstagio');

function chEstagio(){
  const valAtual = document.getElementById('selCoordEstagio').value;
  if (valAtual === valInitEstagio){
    btnEstagio.hidden = true;
  } else {
    btnEstagio.hidden = false;
  }
}

function updEstagio(){
  const valAtual = document.getElementById('selCoordEstagio').value;
  valInitEstagio = valAtual;
  btnEstagio.hidden = true;
}






</script>







