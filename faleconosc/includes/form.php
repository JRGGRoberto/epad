<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-4"><h3>Fale conosco</h3></div>
    <div class="col" style="text-align:left">
        <a class="card-link" href="../ajuda/?help=fale" aria-expanded="true"><span class="badge badge-warning float-right">Ajuda</span></a>
    </div>
  </div>
  <hr>
    <div class="form-group">
      <p></p>
      <form class="form-group" id="faleconosco" name="faleconosco" method="post">
        <div class="form-group">

        <label for="tipomsg">Categoria</label>
          <select name="tipomsg" id="tipomsg" class="form-control" require>
            <option value="2">Dúvidas</option>
            <option value="3">Sugestão</option>
            <option value="4">Erro no sistema</option>
          <!--  <option value="1">Elogio</option> -->
          </select>
        </div>

        <div class="form-group">
          <label for="assunto">Assunto</label>
          <input type="text" name="assunto" id="assunto" class="form-control" require>
        </div>
        
             
        <div class="form-group" >
          <label for="url">Especifique a parte</label>
          <select name="url" id="url"  class="form-control" require>
            <option value="1">ePAD -  Geral</option>
            <option value="2">Meu PAD -  Cálculos</option>
            <option value="3">Meu PAD -  Item 1</option>
            <option value="4">Meu PAD -  Item 2</option>
            <option value="5">Meu PAD -  Item 2.2</option>
            <option value="6">Meu PAD -  Item 3</option>
            <option value="7">Meu PAD -  Item 4</option>
            <option value="8">Meu PAD -  Item 6</option>
            <option value="9">Coordenação - Matrizes</option>
            <option value="10">Coordenação - Distribuição de disciplinas</option>
            <option value="11">Coordenação - Atribuição de funções</option>
            <option value="12">Coordenação - Relatórios</option>
            <option value="13">Edição de dados do professor</option>
            <option value="14">Login</option>
            <option value="15">Outros</option>
          </select>
        </div>
    
        <div class="form-group" >
          <label for="msg">Mensagem</label>  
          <textarea maxlength="250" name="msg" id="msg" cols="30" class="form-control" rows="5"></textarea>
        </div>
          <center>
            <button type="submit" id="addBtnF" class="btn btn-primary btn-sm">Enviar</button>
          </center>
      </form>
    </div>
</div>