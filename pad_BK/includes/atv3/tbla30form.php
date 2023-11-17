<form class="form-group" id="frmAtv3" name="frmAtv3" method="post">

              <div class="form-group">
                <label for="tpProj3">Tipo de projeto</label>
                <select name="tpProj3" id="tpProj3" class="form-control" require>
                  <option value="">Selecione</option>
                  <option value="1">Pesquisa</option>
                  <option value="2">Extensão e cultura</option>
                  <option value="3">Programas especiais</option>
                </select>
              </div>

              <div class="form-group">
                <label for="nome3">Nome</label>
                <input type="text" name="nome3" id="nome3" class="form-control">
                <input type="hidden" name="id3" id="id3">
                <input type="hidden" name="idx3" id="idx3">
                <input type="hidden" name="vinc3" id="vinc3">
              </div>

              <div class="form-group">
                <label for="funcao3">Função</label>
                <select name="funcao3" id="funcao3" class="form-control" require>
                  <option value="">Selecione</option>
                  <option value="1">Coordenador</option>
                  <option value="2">Membro</option>
                  <option value="3">Outro - informar em observações</option>
                </select>
              </div>

              <div class="form-group">
                <label for="orientandos3">Nome dos orientandos <sub>(Se houver)</sub></label>
                <textarea name="orientandos3" id="orientandos3" cols="30" rows="5" class="form-control"></textarea>
              </div>

              <div class="form-group">
                <label for="cargah3">Carga horária</label>
                <input type="text" name="cargah3" id="cargah3" class="form-control">
              </div>

              <center>
                <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalAtv3()">Fechar</button>
                <button type="submit" id="addAtv3" class="btn btn-primary btn-sm" ></button>
              </center>
            </form>