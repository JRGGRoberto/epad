
<div class="container mt-3">

  
<div class="container p-3 my-3 bg-white text-dark" style="padding : 25px">
  <h3>Mensagen</h3>
  <div class="col" style="text-align:right"><a href="./">voltar</a></div>
  
  <table class="table table-bordered table-sm"> 
    <thead>
      <tr>
        <th colspan="1" style="width:160px">Assunto</th>
        <td colspan="5"><?= $msg->assunto; ?></td>
      </tr>
      <tr>
        <th colspan="1" style="width:160px">Mensagem de</th> 
        <td colspan="5"><?= $msg->solicitante .' - '.  $msg->local ?> <br><a href="mailto:<?= $msg->email; ?>"><?= $msg->email; ?></a></td>
      </tr>
      <tr>
          <th colspan="3">Tipo de mensagem</th>
          <th colspan="2" >Parte do sistema</th>
          <th colspan="2">Data de envio</th>
      </tr>
      <tr>
          <td colspan="3"><?= $msg->tp_msg;?></td>
          <td colspan="2"><?= $msg->parte ?></td>
          <td colspan="2"><?= $msg->data_envio ?></td>
      </tr>
      <tr>
          <th colspan="6">Mensagem</th></td>
      </tr>
      <tr>
          <td colspan="6"><?= $msg->msg ?></td>
      </tr>
   
</thead>
</table>



