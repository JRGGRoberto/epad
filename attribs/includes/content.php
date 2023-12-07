<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-2"><h3>Atribuições</h3></div>
    <div class="col" style="text-align:left"><span class="badge badge-pill badge-light">2.2. Atividades de Supervisão e Orientação</span></div>
  </div>
  <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <div style="max-height: 600px; overflow: scroll;">
        <table id="tabelaPADS" name="tabelaPADS" class="table table-bordered table-sm">
          <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
            <tr>
              <th style="display: none;">ID</th>
              <th class="align-top">Professor(ª)</th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.1</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 2.2</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 3</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Ativ. 4</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">CH<br><sup>Total att</sup></th>
              <th class="align-top" style="text-align: center; width: 75px;">RT</th>
              <th class="align-top" style="text-align: center; width: 45px;" >⚙️</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <sub style="line-height: 12px;">
      <strong>Ativ. 2.1</strong>) Total de média semanal anual de carga horária didática; 
      <strong>Ativ. 2.2</strong>) Total de média semanal anual de carga horária supervisão e orientação; 
      <strong>Ativ. 3</strong>) Total de carga horária semanal pesquisa/extensão/cultura/programas especiais; 
      <strong>Ativ. 4</strong>)	Total de carga horária semanal de gestão institucional; 
      <strong>Total att</strong>) Total de carga horária semanal; 
      <strong>RT</strong>) Regime de trabalho.</sub>
    </div>
</div>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMotal">2.2. Atividades de Supervisão e Orientação</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">

<?php
  include './includes/tblform.php';
?>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->

<script src="./includes/tbla22.js"></script>
<script>
function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
}

function frmAtiv22Show(id) {

  btnFecharCanc();
  getDBMD22(id)

  /*
  let idx4 = data4.findIndex(d =>d.id === id);
  let myObj = data4[idx4];
  let id_vinc = document.getElementById('id_vinc').value;

  document.getElementById("vinc4").value = id_vinc;
  document.getElementById("idx4").value = idx4;
  document.getElementById("id4").value  = myObj.id;
  document.getElementById('cargo4').value = myObj.cargo;

  document.getElementById('alocado4').value = myObj.alocado;
  document.getElementById('numdata4').value = myObj.numdata;
  
  document.getElementById('cargah4').value = myObj.ch;

  document.getElementById("titleMotal4").innerHTML = 'Editar atividade';
  document.getElementById("addAtv4").innerHTML = "Alterar";
  */

  $('#modalAtv').modal('show');
}



function deleteAllRows(){
  $("#tabelaPADS tbody tr").remove(); 
}

function insereTable(newDisc){
  // Adicionar uma nova linha na tabela
  let tabela = document.getElementById("tabelaPADS").getElementsByTagName("tbody")[0];
  let newLinha = tabela.insertRow();

    let celId   = newLinha.insertCell(0);
    let celNome = newLinha.insertCell(1);
    let celA21  = newLinha.insertCell(2);
    let celA22  = newLinha.insertCell(3);
    let celA3   = newLinha.insertCell(4);
    let celA4   = newLinha.insertCell(5);
    let celAT   = newLinha.insertCell(6);
    let celRT   = newLinha.insertCell(7);
    let celCnf  = newLinha.insertCell(8);
      
  celId.innerHTML   = newDisc.id;
  celNome.innerHTML = newDisc.nome;
  celA21.innerHTML  = stripZeros(newDisc.a21) +'h ';
  celA22.innerHTML  = newDisc.a22 +'h ';
  celA3.innerHTML   = newDisc.a3 +'h ';
  celA4.innerHTML   = newDisc.a4 +'h ';
  celAT.innerHTML   = parseFloat(newDisc.a21) + parseFloat(newDisc.a22) +parseFloat(newDisc.a3) + parseFloat(newDisc.a4) +'h ';
  celRT.innerHTML   = newDisc.rt +'h ';
  celCnf.innerHTML  = 
  `<center>
    <button type="button" class="btn btn-light btn-sm" onclick="frmAtiv22Show('${newDisc.id}')">⚙️</button>
  </center>`;
  celId.style.display = 'none'; 
  celA21.style.textAlign = 'right';
  celA22.style.textAlign = 'right';
  celA3.style.textAlign = 'right';
  celA4.style.textAlign = 'right';
  celAT.style.textAlign = 'right';
  celRT.style.textAlign = 'right';

  
  //celCH.style.textAlign = 'right';
}

async function getDBMD() {
  deleteAllRows();
  data = await fetch(`../api/pads.php?md=${co}${ano}`).then(resp => resp.json()).catch(error => false);
  if (data.length > 0){
    data.forEach(e => insereTable(e));
   } 
}

getDBMD();

</script>