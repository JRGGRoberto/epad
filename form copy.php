<!DOCTYPE html>
<html lang="en">

<head>
  <title>PROGRAD - ePAD UNESPAR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="./ccc.js"></script>
</head>

<body>

  <div class="container mt-3">
    <h1>Matrizes de Disciplinas</h1>

    <hr>

    <div class="row">
      <div class="col-2">
        <div class="form-group">
          <label for="ca">Campus</label>
          <select name="id_campus" id="ca" class="form-control" required onchange="desabilitar()">
            <?= $CAop ?>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="ce">Centro</label>
          <select name="id_centro" id="ce" class="form-control" required onchange="desabilitar()">
            <?= $CEop ?>
          </select>
        </div>
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="co">Curso</label>
          <select name="id_colegiado" id="co" class="form-control" required onchange="ativaEdtAno();">
            <?= $Coop ?>
          </select>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <table class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="width:20px"></th>
            <th>
              Para o ano letivo de:
              <input type="number" name="anoLetivo" id="anoLetivo" min="2023" max="2099" maxlength="4" style="width:65px" onchange="ativaBTNsLA();" disabled>
              <button type="button" class="btn btn-primary btn-sm" onclick="carregarDados()" disabled id="btnListarAnosL">Listar</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="formAddMatDis()" disabled id="btnAdicionarAnosL">Adicionar</button>
            </th>

          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>


    <!-- TABLE -->
    <div class="form-group table-responsive-sm">
      <table id="tabelaMatD" class="table table-bordered table-sm">
        <thead class="thead-light">
          <tr>
            <th style="display: none;">ID</th>
            <th>Ano</th>
            <th>Curso</th>
            <th>Período</th>
            <th>Carga horária</th>
            <th style="text-align: center;"><button type="button" class="btn btn-warning" disabled=""></button></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="modalDis">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titleMemb">TITULO</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form class="form-group" id="frmMatriz" name="frmMatriz" action="data.php" method="post">
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label for="anoLet">Ano letivo</label>
                    <input type="text" class="form-control" id="anoLet" name="ano" readonly>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="nomeCurso">Curso</label>
                    <input type="text" class="form-control" id="nomeCurso" readonly>
                    <input type="hidden" name="id_md" id="id_md">
                    <input type="hidden" name="id_cam" id="id_camp_form">
                    <input type="hidden" name="id_cen" id="id_cent_form">
                    <input type="hidden" name="id_cur" id="id_curs_form">
                    <input type="hidden" name="to_do" id="to_do">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="chTotal">Carga horária</label>
                    <input type="text" class="form-control" id="chTotal" name="ch" require>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="habilitacao">Habilitação</label>
                    <select name="habilitacao" id="habilitacao" class="form-control" require>
                      <option value="">Selecione</option>
                      <option value="l">Licenciatura</option>
                      <option value="b">Bacharelado</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="oferta">Regime de oferta</label>
                <select name="oferta" id="oferta" class="form-control" require>
                  <option value="">Selecione</option>
                  <option value="a">Seriado anual com disciplinas anuais</option>
                  <option value="s">Seriado anual com disciplinas semestrais</option>
                  <option value="m">Seriado anual com disciplinas anuais e semestrais (misto)</option>
                </select>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="periodo">Período de funcionamento</label>
                    <select name="periodo" id="periodo" class="form-control" require>
                      <option value="">Selecione</option>
                      <option value="m">Matutino</option>
                      <option value="v">Vespertino</option>
                      <option value="n">Noturno</option>
                      <option value="i">Integral</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="vagas">Vagas</label>
                    <input type="text" class="form-control" id="vagas" name="vagas" require>
                  </div>
                </div>
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDis()">Fechar</button>
                <button type="button" id="addMatrDis" class="btn btn-primary btn-sm" onclick="post_MD()">Adicionar</button>
                <button type="button" name="altMemb" class="btn btn-primary btn-sm" onclick="post_MD()">Alterar</button>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal Fim-->

  </div>

  <script>
    matrizDisc = [{
        "id": "123132132132",
        "id_curso": "c3bbf72b-3b64-11ed-9793-0266ad9885af",
        "ano": 2005,
        "curso": "Ciência da Computação",
        "turno": "Noturno",
        "ch": 3600,
        "habilitacao": "b",
        "regime": "s",
        "vagas": 50
      },
      {

        "id": "96382741",
        "id_curso": "c3bbf72b-3b64-11ed-9793-0266ad9885af",
        "ano": 2005,
        "curso": "Português",
        "turno": "Matutino",
        "ch": 3600,
        "habilitacao": "l",
        "regime": "a",
        "vagas": 50

      }
    ];

    function post_MD() {
      document.frmMatriz.submit();
    }

    function deleteAllRows() {
      $("#tabelaMatD tbody tr").remove();
    }

    function carregarDados() {
      deleteAllRows();
      getDBMD();
    }

    function insereTable(newData) {
      // Adicionar uma nova linha na tabela
      let tabela = document.getElementById("tabelaMatD").getElementsByTagName("tbody")[0];

      let novaLinha = tabela.insertRow();
      let celId = novaLinha.insertCell(0);
      let celAno = novaLinha.insertCell(1);
      let celCurso = novaLinha.insertCell(2);
      let celTurno = novaLinha.insertCell(3);
      let celCh = novaLinha.insertCell(4);
      let celDelete = novaLinha.insertCell(5);

      celId.innerHTML = newData.id;

      celId.style.display = 'none';

      celAno.innerHTML = newData.ano;
      celCurso.innerHTML = newData.curso;

      let turno;
      switch (newData.turno) {
        case 'm':
          turno = 'Matutino';
          break;
        case 'v':
          turno = 'Vespertino';
          break;
        case 'n':
          turno = 'Noturno';
          break;
        case 'i':
          turno = 'Integral';
          break;
        default:
          turno = 'Não definido';
      };

      celTurno.innerHTML = turno;
      celCh.innerHTML = newData.ch;
      celDelete.innerHTML = `<center><button type="button" class="btn btn-light btn-sm" onclick="formEditarDados('${newData.id}')" data-toggle="tooltip" data-placement="bottom" title="Editar">✏️</button> <button type="button" class="btn btn-light btn-sm" onclick="configDisc('${newData.id}')" data-toggle="tooltip" data-placement="right" title="Configurar">⚙️</button></center>`;
    }

    async function getDBMD() {
      let ano = document.getElementById('anoLetivo').value;
      let id = document.getElementById('co').value;
      let a = id + ano;
      matrizDisc = await fetch(`./api/matriz.php?md=${a}`).then(resp => resp.json()).catch(error => false);
      if (!matrizDisc) return;
      matrizDisc.forEach(e => insereTable(e));
    }

    function desabilitar() {
      document.getElementById('btnListarAnosL').disabled = true;
      document.getElementById('btnAdicionarAnosL').disabled = true;
      document.getElementById('anoLetivo').value = '';
      document.getElementById('anoLetivo').disabled = true;
    }

    function ativaEdtAno() {
      var anoLetivoEdt = document.getElementById('anoLetivo');
      var colegiadocur = document.getElementById('co').value;
      if (!anoLetivo.value) {
        anoLetivoEdt.disabled = false;
      } else {
        desabilitar();
      }
    }

    function ativaBTNsLA() {
      let btnListarAnosL = document.getElementById('btnListarAnosL');
      let btnAdicionarAnosL = document.getElementById('btnAdicionarAnosL');
      var anoLetivoEdt = document.getElementById('anoLetivo').value;
      if (anoLetivoEdt.length = 4) {
        btnListarAnosL.disabled = false;
        btnAdicionarAnosL.disabled = false;
      } else {
        btnListarAnosL.disabled = true;
        btnAdicionarAnosL.disabled = true;
      }
    }

    function fecharModalDis() {
      clearModal();
      $('#modalDis').modal('hide');
    }

    function preencheForm(id){
      let index = matrizDisc.findIndex(e => e.id === id);
      let myObj = matrizDisc[index];
      document.getElementById("id_md").value = id;
     // Preenche os inputs
      document.getElementById("anoLet").value = myObj.ano;
      document.getElementById("nomeCurso").value = myObj.curso;
      document.getElementById("chTotal").value = myObj.ch;
      document.getElementById("habilitacao").value = myObj.habilitacao;
      document.getElementById("oferta").value = myObj.oferta;
      document.getElementById("vagas").value = myObj.vagas;
      document.getElementById("periodo").value = myObj.turno;
      document.getElementById("to_do").value = 'upd';
      
      let nomeCurso = document.getElementById('nomeCurso');
      let selCam = document.getElementById('ca');
      let selCen = document.getElementById('ce');
      let selCur = document.getElementById('co');
      nomeCurso.value = selCur.options[selCur.selectedIndex].text;

      let id_camp_form = document.getElementById("id_camp_form");
      let id_cent_form = document.getElementById("id_cent_form");
      let id_curs_form = document.getElementById('id_curs_form');
      
      id_camp_form.value = selCam.value;
      id_cent_form.value = selCen.value;
      id_curs_form.value = selCur.value;
    }

    function configDisc(id){
      preencheForm(id);
      document.getElementById("to_do").value = 'conf';
      document.frmMatriz.submit();
    }

    function formEditarDados(id) {

      document.getElementById("titleMemb").innerHTML = 'Editar dados da Matriz de Disciplinas';
      document.getElementById("addMatrDis").hidden = true;
      document.getElementsByName("altMemb")[0].hidden = false;

      preencheForm(id);
      
      $('#modalDis').modal('show');
    };

    function formAddMatDis() {
      clearModal();
      document.getElementById("titleMemb").innerHTML = 'Adicionar Matriz de Disciplinas';
      let anoLet = document.getElementById('anoLet');
      anoLet.value = document.getElementById('anoLetivo').value;

      document.getElementById("to_do").value = 'add';

      let nomeCurso = document.getElementById('nomeCurso');
      let selCam = document.getElementById('ca');
      let selCen = document.getElementById('ce');
      let selCur = document.getElementById('co');
      nomeCurso.value = selCur.options[selCur.selectedIndex].text;

      let id_camp_form = document.getElementById("id_camp_form");
      let id_cent_form = document.getElementById("id_cent_form");
      let id_curs_form = document.getElementById('id_curs_form');
      
      id_camp_form.value = selCam.value;
      id_cent_form.value = selCen.value;
      id_curs_form.value = selCur.value;

      $('#modalDis').modal('show');
      document.getElementById("addMatrDis").hidden = false;
      document.getElementsByName("altMemb")[0].hidden = true;
    }

    function clearModal() {
      document.getElementById("id_md").value = '';
      document.getElementById("to_do").value = '';
      document.getElementById("chTotal").value = "";
      document.getElementById("habilitacao").selectedIndex = 0;
      document.getElementById("oferta").selectedIndex = 0;
      document.getElementById("periodo").selectedIndex = 0;
      document.getElementById("vagas").value = "";
      document.getElementById("id_camp_form").value = '';
      document.getElementById("id_cent_form").value = '';
      document.getElementById("id_cent_form").value = '';
      document.getElementById('chTotal').focus();
    }


    window.onload = function() {
      desabilitar();
    };

    function preenche(ca, ce, co, ano) {
      pegarCA().then(
        (onResolved) => {
          selectOpt("ca",  ca  )
        }
      ).then(
        (onResolved) => {
          pegarCE(ca).then(
            (onResolved) => {
              selectOpt("ce",  ce  )
            }
          )
        }
      ).then(
        (onResolved) => {
          pegarCO( ce  ).then(
            (onResolved) => {
              selectOpt("co",  co  )
            }
          )
        }
      ).then(
        (onResolved) => {
          document.getElementById('anoLetivo').disabled = false;
          document.getElementById('anoLetivo').value = ano;
          document.getElementById('btnListarAnosL').disabled = false;  
          document.getElementById('btnAdicionarAnosL').disabled = false;  
        }
      ).then((onResolved) => {
          setTimeout(function() {
             carregarDados();
          }, 700);
        }
      )
    }

    pegarCA();


    <?=$script?>


  </script>




</body>

</html>