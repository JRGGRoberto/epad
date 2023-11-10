<section>
    <input type="hidden" name="id_vinc" id="id_vinc" value="<?= $vinc->id ?>" >

    <div class="card mt-2">
        <div class="card-header">
            <strong>1. Dados do Docente</strong>
        </div>
        <div id="dadosDoc" class="collapse show" data-parent="#accordion" style="">
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
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ21" aria-expanded="false"><strong>2.1. Atividades Didáticas</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Média semanal anual da carga horária didática: <strong><span id="total21" style="padding-left: 20px;">0</span></strong></div>
                </div>
            </div>

            <div id="ativ21" class="collapse" data-parent="#accordion" style="">
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
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ22" aria-expanded="false"><strong>2.2. Atividades de Supervisão e Orientação</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Média semanal anual da carga horária de orientação e supervisão: <strong><span id="total22" style="padding-left: 20px;">0</span></strong></div>
                </div>
            </div>

            <div id="ativ22" class="collapse" data-parent="#accordion" style="">
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
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ3" aria-expanded="false"><strong>3. Atividades de Pesquisa / Extensão / Cultura e Programas Especiais</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Total de carga horária semanal Pesquisa/Extensão/Cultura/Programas Especiais: <strong><span id="total3" style="padding-left: 20px;">0</span></strong></div>
                </div>
            </div>

            <div id="ativ3" class="collapse" data-parent="#accordion" style="">
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
                    <div class="col-sm"><a class="card-link collapsed" data-toggle="collapse" href="#ativ4" aria-expanded="false"><strong>4. Atividades de Gestão Institucional</strong></a></div>
                </div>
                <div class="row">
                    <div class="col-sm d-flex justify-content-end">Total de carga horária semanal de gestão institucional: <strong><span id="total4" style="padding-left: 20px;">0</span></strong></div>
                </div>
            </div>

            <div id="ativ4" class="collapse" data-parent="#accordion" style="">
                <div class="card-body">

                    <?php
                    include './includes/atv4/tbla40.php';
                    ?>

                </div>
            </div>
        </div>

    </div>


    <div class="card mt-2">
        <div class="card-header">
            <strong>5. Resumo das atividades e totalização</strong>
        </div>
        <div id="resumo" class="collapse show" data-parent="#accordion" style="">
            <div class="card-body">
                <table class="table table-bordered table-sm">

                    <tr>
                        <th>2.1</th>
                        <th>Total de média semanal anual de carga horária didática</th>
                        <td style="text-align: right">
                            <strong><span id="rtotal21" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span>h</strong>
                        </td>
                    <tr>
                        <th>2.2</th>
                        <th>Total de média semanal anual de carga horária supervisão e orientação</th>
                        <td style="text-align: right">
                            <strong><span id="rtotal22" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span>h</strong>
                        </td>
                    <tr>
                        <th>3</th>
                        <th>Total de carga horária semanal pesquisa/extensão/cultura/programas especiais</th>
                        <td style="text-align: right">
                            <strong><span id="rtotal3" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span>h</strong>
                        </td>
                    <tr>
                        <th>4</th>
                        <th>Total de carga horária semanal de gestão institucional</th>
                        <td style="text-align: right">
                            <strong><span id="rtotal4" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span>h</strong>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">Total de carga horária semanal</th>
                        <td style="text-align: right">
                            <strong><span id="rtotal" style="padding-left: 20px;"><div class="spinner-grow spinner-grow-sm text-primary"></div></span>h</strong>
                        </td>
                    </tr>


                </table>

            </div>
        </div>
    </div>


    <div class="card mt-2">
        <div class="card-header">
            <strong>6. Outras Observações</strong>
        </div>
        <div id="resumo" class="collapse show" data-parent="#accordion" style="">
            <div class="card-body">
                <input type="text" name="" id="" value="<?= $vinc->obs ?>">
            </div>
        </div>
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
                Tem certeza que deseja apagar a atividade abaixo? 
                <div class="d-flex justify-content-center mb-3" id="nomeDisDel"></div>
                <input type="hidden" name="idAtivDel" id="idAtivDel">
                <input type="hidden" name="idAtivDelOrigem" id="idAtivDelOrigem">
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

/*
function frmExcluirShow(id){
  $('#modalDel').modal('show');


  let nomeDisDel = document.getElementById('nomeDisDel');
  let id_disDel = document.getElementById('id_disDel');
  let index = disciplinas.findIndex(e => e.id === id);
  let myObj = disciplinas[index];
  nomeDisDel.innerHTML =  myObj.nome;
  id_disDel.value = myObj.id;
}
*/


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

    document.getElementById('rtotal').innerHTML = soma;
}


const myInterval = window.setInterval(function() {
    somaTotais()
}, 5000);

getDBMD21();
</script>

