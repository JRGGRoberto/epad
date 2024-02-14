<form class="form-group" id="frmAtv4" name="frmAtv4" method="post">

    <div class="form-group">
      <label for="cargo4">Cargo</label>
       <input type="text" name="cargo4" id="cargo4" class="form-control"> 
    <!--  <select name="cargo4" require id="cargo4" class="form-control">
        <optgroup label="Atividades de Gestão Institucional - Direção Superior">
          <option value="Reitor">Reitor</option>
          <option value="Vice-Reitor">Vice-Reitor</option>
        </optgroup>
        <optgroup label="Direção e Função Acadêmica">
          <option value="Pró-reitor">Pró-reitor</option>
          <option value="Chefe de Gabinete da Reitoria">Chefe de Gabinete da Reitoria</option>
          <option value="Assessoria de Comunicação">Assessoria de Comunicação</option>
          <option value="Assessor da Reitoria">Assessor da Reitoria</option>
          <option value="Procurador">Procurador</option>
          <option value="Auditor">Auditor</option>
          <option value="Agente de Transparência e Ouvidoria">Agente de Transparência e Ouvidoria</option>
          <option value="Diretor de Campus">Diretor de Campus</option>
          <option value="Vice-diretor de Campus">Vice-diretor de Campus</option>
          <option value="Diretor de Pró-reitoria">Diretor de Pró-reitoria</option>
          <option value="Coordenador de Concursos">Coordenador de Concursos</option>
          <option value="Diretor de Centro de Áreas">Diretor de Centro de Áreas</option>
        </optgroup>
        <optgroup label="Função Acadêmica">
          <option value="Chefe de Divisão de Pró-Reitoria">Chefe de Divisão de Pró-Reitoria</option>
          <option value="Coordenador de Curso de Graduação">Coordenador de Curso de Graduação</option>
          <option value="Coordenador de Programa de Pós-graduação Stricto Sensu">Coordenador de Programa de Pós-graduação Stricto Sensu</option>
          <option value="Assessor Técnico">Assessor Técnico</option>
          <option value="Chefe de Gabinete de Diretor de Campus">Chefe de Gabinete de Diretor de Campus</option>
          <option value="Chefe de Divisão de Campus">Chefe de Divisão de Campus</option>
          <option value="Chefe de Seção de Campus">Chefe de Seção de Campus</option>
        </optgroup>
        <optgroup label="Atividades Administrativas e Representativas">
          <option value="Conselhos">Conselhos</option>
          <option value="Comissões e Comitês Permanentes">Comissões e Comitês Permanentes</option>
          <option value="Coordenações">Coordenações</option>
        </optgroup>
      </select>-->

      <input type="hidden" name="id4" id="id4">
      <input type="hidden" name="idx4" id="idx4">
      <input type="hidden" name="vinc4" id="vinc4">
    </div>

    <div class="form-group">
      <label for="alocado4">Local</label>
      <input type="text" name="alocado4" id="alocado4" class="form-control">
    </div>
    
    <div class="form-group">
      <label for="numdata4">Número e data Ato Legal</label>
      <input type="text" name="numdata4" id="numdata4" class="form-control">
    </div>

    <div class="form-group">
      <label for="cargah4">Carga horária semanal</label>
      <input type="number" name="cargah4" id="cargah4" class="form-control"  pattern="[0-9]+$" >
    </div>

    <center>
      <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalAtv4()">Fechar</button>
      <button type="submit" id="addAtv4" class="btn btn-primary btn-sm" ></button>
    </center>
  </form>