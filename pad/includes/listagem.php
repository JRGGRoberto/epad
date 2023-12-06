<div class="container mt-3">
    <h3>PAD <?=$vinc->ano?></h3>
<section>
    <input type="hidden" name="id_vinc" id="id_vinc" value="<?= $vinc->id ?>" >

    <div class="card mt-2">
        <div class="card-header">
            <strong>1. Dados do Docente</strong>
        </div>
        <div id="dadosDoc" class="collapse show" >
            <div class="card-body">
                <?php
                include './includes/tbla10.php';
                ?>

            </div>
        </div>
    </div>



    <div id="accordion">

        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm">
                        <a class="card-link collapsed" data-toggle="collapse" href="#ativ21" aria-expanded="false">
                        <strong>2.1. Atividades Didáticas</strong></a>
                    </div>
                    <div class="col-sm small d-flex justify-content-end">
                        Média semanal anual da carga horária didática: <strong><span id="total21" style="padding-left: 20px;">0</span></strong>
                    </div>
                </div>
                
            </div>

            <div id="ativ21" class="collapse show" >
                <div class="card-body">

                    <?php
                    include './includes/atv21/tbla21.php';
                    ?>

                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ22" aria-expanded="false">
                        <strong>2.2. Atividades de Supervisão e Orientação</strong></a>
                    </div>
                    <div class="col-sm small d-flex justify-content-end">
                        Média semanal anual da carga horária de orientação e supervisão: <strong><span id="total22" style="padding-left: 20px;">0</span></strong>
                    </div>
                </div>
            </div>

            <div id="ativ22" class="collapse show" >
                <div class="card-body">
                    
                    <?php
                      include './includes/atv22/tbla22.php';
                    ?>
                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-7"><a class="card-link collapsed" data-toggle="collapse" href="#ativ3" aria-expanded="false">
                        <strong>3. Atividades de Pesquisa / Extensão / Cultura e Programas Especiais</strong></a>
                    </div>
                    <div class="col-sm small d-flex justify-content-end">
                        Total de carga horária semanal Pesq/Ext/Cult/ProgEspeciais: <strong><span id="total3" style="padding-left: 20px;">0</span></strong>
                    </div>
                </div>
            </div>

            <div id="ativ3" class="collapse show" >
                <div class="card-body">
                    <?php
                    include './includes/atv3/tbla30.php';
                    ?>
                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ4" aria-expanded="false">
                        <strong>4. Atividades de Gestão Institucional</strong></a>
                    </div>
                    <div class="col-sm small d-flex justify-content-end">Total de carga horária semanal de gestão institucional: <strong><span id="total4" style="padding-left: 20px;">0</span></strong>
                    </div>
                </div>
            </div>

            <div id="ativ4" class="collapse show" >
                <div class="card-body">
                    <?php
                    include './includes/atv4/tbla40.php';
                    ?>
                </div>
            </div>
        </div>

         <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                        <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#resumo" aria-expanded="false">
                            <strong>5. Resumo das atividades e totalização</strong></a>
                        </div>
                </div>
            </div>
            <div id="resumo" class="collapse show" >
                <div class="card-body d-flex align-items-center justify-content-center " >
                    <table class="table table-sm" style="max-width: 800px;" >
    
                        <tr>
                            <th>2.1</th>
                            <th>Total de média semanal anual de carga horária didática</th>
                            <td style="text-align: right">
                                <strong><span id="rtotal21" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span></strong>
                            </td>
                        <tr>
                            <th>2.2</th>
                            <th>Total de média semanal anual de carga horária supervisão e orientação</th>
                            <td style="text-align: right">
                                <strong><span id="rtotal22" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span></strong>
                            </td>
                        <tr>
                            <th>3</th>
                            <th>Total de carga horária semanal pesquisa/extensão/cultura/programas especiais</th>
                            <td style="text-align: right">
                                <strong><span id="rtotal3" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span></strong>
                            </td>
                        <tr>
                            <th>4</th>
                            <th>Total de carga horária semanal de gestão institucional</th>
                            <td style="text-align: right">
                                <strong><span id="rtotal4" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span></strong>
                            </td>
                        </tr>
    
                        <tr>
                            <th colspan="2" style="text-align: right;">Total de carga horária semanal</th>
                            <td style="text-align: right">
                                <strong><span id="rtotal" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span></strong>
                            </td>
                        </tr>
    
    
                    </table>
                </div>
            </div>
        </div>


        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm">
                        <a class="card-link collapsed" data-toggle="collapse" href="#outobs" aria-expanded="false"><strong>6. Outras Observações</strong></a>
                    </div>
                </div>
            </div>
            <div id="outobs" class="collapse show" >
                <div class="card-body">
                    <div class="form-group">
                         <textarea onKeyUp="AtivaupdateOBS()" name="vincobs" id="vincobs" cols="30" class="form-control" rows="5"><?= $vinc->obs ?></textarea>
                    </div>
                    <div class="form-group float-right">
                         <input id="updateObsBtn" type="button" value="Salvar observação" class="btn btn-primary btn-sm" value="" onclick="updateOBS();" hidden>
                     </div>
                </div>
            </div>
        </div>
    </div>  
    <div>
        .
    </div>


</section>


    <!-- The Modal DELET-->
    <div class="modal fade" id="modalDel">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" >Remover atividade</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post">
              <div class="form-group">
              <div  id="msgApagar">Tem certeza que deseja apagar a atividade abaixo?</div>
                <div class="d-flex justify-content-center mb-3 font-weight-bold" id="nomeAtivDel">AAA</div>
                <input hidden name="idAtivDel" id="idAtivDel">
                <input hidden name="ativX" id="ativX">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm" >Apagar</button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->




<script>

function AtivaupdateOBS(){
    const updateObsBtn = document.getElementById('updateObsBtn');
    updateObsBtn.hidden = false;
}

function updateOBS(){
    let id_v = document.getElementById("id_vinc").value;
    let obst = document.getElementById("vincobs").value;
    const updateObsBtn = document.getElementById('updateObsBtn');

    data = {
             id: id_v,
             obs: obst
           };
           
    fetch('./includes/dml/updateObs.php', {
        method:'PUT',
        headers:{
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then( res => res.json());
    updateObsBtn.hidden = true;
}


function stripZeros(str) {
  return parseFloat(str.replace(',', '.'))
    .toString()
    .replace('.', ',');
}

function frmExcluirShow(aid){
  const ativ = parseInt(aid.substr(1, 1));
  const id = aid.substr(2, 36);
  let nomeAtivDel = document.getElementById('nomeAtivDel');
  let idAtivDel = document.getElementById('idAtivDel');
  let ativX = document.getElementById('ativX');
  ativX.value = ativ;
  var index;
  if(ativ === 3){
    index = data3.findIndex(e => e.id === id);
    var myObj = data3[index];
    idAtivDel.value = myObj.id;
    nomeAtivDel.innerHTML = myObj.nome;
    $('#modalDel').modal('show');
  } if (ativ === 4) {
    index = data4.findIndex(e => e.id === id);
    var myObj = data4[index];
    idAtivDel.value = myObj.id;
    nomeAtivDel.innerHTML =  myObj.cargo +' - '+ myObj.alocado + ' - ' + myObj.numdata;
    $('#modalDel').modal('show');
  } else {
    return;
  }
  // nomeAtivDel.innerHTML =  myObj.nome;
}

const frmDelAtiv = document.getElementById('frmDelAtiv');
frmDelAtiv.addEventListener('submit', e => {
  e.preventDefault();
  let nomeAtivDel = document.getElementById('nomeAtivDel');
  let idAtivDel = document.getElementById('idAtivDel').value;
  let ativX = document.getElementById('ativX').value;

  if(ativX === '3'){
    removAtiv3(idAtivDel);
  }
  
  if(ativX === '4'){
    removAtiv4(idAtivDel);
  }
});


function somaTotais() {

    let total21 = document.getElementById('total21').innerHTML;
    let total22 = document.getElementById('total22').innerHTML;
    let total3 = document.getElementById('total3').innerHTML;
    let total4 = document.getElementById('total4').innerHTML;

    document.getElementById('rtotal21').innerHTML = total21;
    document.getElementById('rtotal22').innerHTML = total22;
    document.getElementById('rtotal3').innerHTML = total3;
    document.getElementById('rtotal4').innerHTML = total4;
    soma = (parseFloat(total21) + parseFloat(total22) + parseFloat(total3) + parseFloat(total4));

    document.getElementById('rtotal').innerHTML = soma + 'h';
}


const myInterval = window.setInterval(function() {
    somaTotais()
}, 5000);

getDBMD21();
</script>

