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
              <input type="number" name="anoLetivo" id="anoLetivo" min="2023" max="2099" maxlength="4" style="width:65px" readonly >
              <button type="button" class="btn btn-primary btn-sm" onclick="carregarDados()" disabled id="btnListarAnosL" hidden>Listar</button>
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
            <th>Nome</th>
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
                    <input type="hidden" name="uid" id="uid" value="<?=$uid?>">
                    <input type="hidden" name="to_do" id="to_do">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" require>
              </div>

              <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for="categ">Categoria</label>
                    <select name="categ" id="categ" class="form-control" require="">
                      <option value="">Selecione</option>
                      <option value="a">Graduação</option>
                      <option value="b">Pós-graduação Lato Sensu gratuita</option>
                      <option value="c">Pós-graduação Stricto Sensu</option>
                    </select>
                  </div>
                </div>


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



<script src="./ccc1.js"></script>
<script>
pegarCA();

</script>
