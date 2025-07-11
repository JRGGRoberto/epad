<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-6">
      <h3>Afastamento</h3>
      <?php
         echo '<h5>'.$colegiado->nome.'  '.$user['year_sel'].'</h5>';
      ?>
    </div>
    <div class="col" style="text-align:left">
      <div><p hidden style="text-align: justify;   text-justify: inter-word;">
        O(A) professor(a) <?php echo $cargoAttri->nome_tt; ?>, 
        como coordenador(a) do curso de <?php echo $cargoAttri->colegiado_tt; ?> (
        <?php echo strtoupper($cargoAttri->codcam_tt); ?>/<?php echo $cargoAttri->codcentro_tt; ?>), 
        atribuiu a ti a função de coordenador do(a) <strong><?php echo $cargoAttri->tipo; ?></strong>. 
        Deverás atender os alunos do curso <strong><?php echo $cargoAttri->colegiado_tt; ?></strong>, designando-os aos professores disponíveis e mais adequados para orientá-los.
        </p>
        <a class="card-link" href="../ajuda/?help=menu_orientar" aria-expanded="true"><span class="badge badge-warning float-right" hidden>Ajuda</span></a>
      </div>
    </div>
  </div>
  <hr>
    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <div style="max-height: 600px; overflow: scroll;">
        <table id="tabelaAtrib" name="tabelaAtrib" class="table table-bordered table-sm  table-hover">
          <thead class="thead-light" style="background: white; position: sticky; top: 0; z-index: 10;">
            <tr>
              <th style="display: none;">ID</th>
              <th class="align-top" style="text-align: left; width: 400px;">Professor(a)</th>
              <th class="align-top" style="text-align: center; width: 30px;">PAD</th>
              
              <th class="align-top" style="text-align: left;" >Modalidade</th>
              <th class="align-top" >Tipo</th>
              <th class="align-top" >Portaria</th>
              <th class="align-top" style="text-align: center;" width="75px">CH</th>
              <th class="align-top" >Início</th>
               <th class="align-top" >Fim</th>

              <th class="align-top" style="text-align: center; width: 45px;"><button type="button" class="btn btn-primary btn-sm" onclick="formAddAtv()">➕</button></th>
            </tr>
          </thead>
          <tbody>
            <?php echo $listaAfastados; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>


    <!-- The Modal ADD / EDT-->
    <div class="modal fade" id="modalAtv">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title" id="titleMotal">Adicionar afastamento</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body"  style="padding-top: 0px;">
            <span class="badge badge-light" id="titleMotalProf"></span>

<?php

  $ca_nome = $user['ca_nome']; // ['lota_nome'];
      $co_nome = $user['co_nome'];
      include './includes/tblform.php';
      ?>
            
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal ADD / EDT Fim-->


    <!-- The Modal DELET-->
    <div class="modal fade" id="modalDel">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" >Remover afastamento</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmDelAtiv" name="frmDelAtiv" method="post" action="./includes/delete.php">
              <div class="form-group">
              <div  id="msgApagar">Tem certeza que deseja remover a informação de afastamento?</div>
                <div class="justify-content-center mb-3 font-weight-bold" id="nomeRelacao">AAA</div>
                <input hidden name="idAtivDel" id="idAtivDel">
               
              </div>
    
              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDel()">Fechar</button>
                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
              </center>
    
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--  The Modal DELET Fim-->

<script> 


var listaProfs = <?php echo $listaProfs; ?> ;

var listaAfastados = <?php echo $listaAfas; ?> ;


function inserirListaProf(data){

  optionProf = document.getElementById('vinculo');
  optionProf.innerHTML = `<option value="">Selecione</option>`;
  data.forEach(e => {
    let aprovCO ='';
    let aprovCE ='';
    if(e["aprov_co_id"]){
      aprovCO = 'Aprovado';
    }

    if(e["aprov_ce_id"]){
      aprovCE = 'Homologado';
    }

    optionProf.innerHTML += `<option value="${e["id"]}">${e["nome"]} [${e["rt"]}] ${aprovCO} ${aprovCE}</option>`
  });
}

function chListaProfs(){
  /*
  const listaFunc = document.getElementById('listaFunc');
  console.log(listaFunc.value);
  if(listaFunc.value == '20' || 
     listaFunc.value == '21' ||
     listaFunc.value == '22' 
  ){
    inserirListaProf(listaProfs);
  } else if (listaFunc.value == '10') {
    inserirListaProf(listaProfsAll);
  } */
  inserirListaProf(listaProfs); 
}


function formAddAtv(){
  $('#modalAtv').modal('show');
  const formMod = document.getElementById('modalAtv');
  document.getElementById("frmAddAfast").reset();
}

function fecharFormAddAtv(){
  $('#modalAtv').modal('show');

}

function fecharModalDel(){            
  $('#modalDel').modal('hide');
}

function formaData(dt){
   const dataString = dt;
   return dataString.substr(8,2)  + '/' + dataString.substr(5,2)  + '/' + dataString.substr(0,4) ;
}

function modald(cod){
  switch(cod){
     case '10': 
       return 'Médico';
        break;
     case '20':
       return 'Mestrado';
        break; 
     case '21':
       return 'Doutorado';
        break; 
     case '22':
      return 'Pós-Doutorado';
       break; 
   }

}

function frmExcluirShow(id){
  $('#modalDel').modal('show'); 
  let nomeRelacao  = document.getElementById('nomeRelacao');
  let idAtivDel = document.getElementById('idAtivDel');

  let idx = listaAfastados.findIndex( e =>  e.id24 === id );
  console.log(id + '  ' +  idx);
  if(idx != -1) {
    nomeRelacao.innerHTML = listaAfastados[idx].nome + '<br> Período: ' 
                        + formaData(listaAfastados[idx].dt_inicio) + ' a ' 
                        + formaData(listaAfastados[idx].dt_fim) + '<br>'
                        + modald(listaAfastados[idx].modalidade);
    idAtivDel.value = listaAfastados[idx].id24;
  }
}

function setTotalCH(){
  let vinculoSel = document.getElementById('vinculo');
  let chAfasta = document.getElementById('chAfasta');
  let idx = listaProfs.findIndex( e=> e.id = vinculoSel.value);
  if(idx >= 0) {
    chAfasta.value = listaProfs[idx].rt == 'TIDE'? 40 : listaProfs[idx].rt;
  }
  console.log(vinculoSel.value + '  '+ idx);
}

</script>

