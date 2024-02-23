<div class="container mt-3" style="margin-bottom: 0px;">
  <div class="row">
    <div class="col-4"><h3>Fale conosco</h3></div>
    <div class="col" style="text-align:left">
        <a class="card-link" href="../ajuda/?help=fale" aria-expanded="true"><span class="badge badge-warning float-right">Ajuda</span></a>
    </div>
  </div>
  <hr>
    <div class="form-group">
      <p>Caro(a) professor(a)/Agente <strong><?=$user['nome'] ?></strong>, sua mensagem foi encaminhada com sucesso.</p>
      <p>Protocolo nº <strong><?=$idresp ?></strong></p>

      <p>Parte: <strong><?= $parte ?></strong> </p>

      <p>Tipo de mensagem: <strong><?= $tp ?></strong> </p>

      <p>Mensagem: <strong><?= $fale->msg ?></strong> </p>


    </div>
</div>
