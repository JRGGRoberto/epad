<?php 
  $alertaLogin  = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>': '';
  $alertaCadastro = strlen($alertaCadastro) ? '<div class="alert alert-danger">'.$alertaCadastro.'</div>': '';
?>
<p></p>
<div class="jumbotron text-dark">

  <div class="row">

    <div class="col text-center">

        <h2>PROEC</h2>
        <img src="../imgs/logo_unespar.png" width="150" height="160">
        <hr>
        <h3>PLANO DE ATIVIDADES DOCENTES</h3>
        <h4><span class="badge badge-warning">Envio de Projetos</span></h4>  
        <span>ePAD</span>

    </div>

    <div class="col">

      <form method="post">

        <h2>Login</h2>
        <?=$alertaLogin?>

        <div class="form-group">
          <label>E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="form-group">
          <button type="submit" name="acao" value="logar" class="btn btn-primary">🔑 Entrar</button>
        </div>

      </form>

      <br>
      <!--
      <a href="../projetostb/" class="btn btn-success" id="projEfet">📑 Propostas efetivadas</a>
      <label for="projEfet">Acessar projetos que já passaram por todos os crivos estabelecidos</label>
-->

    </div>

  </div>

</div>