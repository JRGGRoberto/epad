<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
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
  <h1>Disciplinas</h1>

  <hr>

  <div class="row">
    <div class="col-2">
      <div class="form-group">
        <label for="ca">Campus</label>
        <select name="id_campus" id="ca" class="form-control" required>
        <?=$CAop?>
        </select>
      </div> 
    </div>

    <div class="col-5">
      <div class="form-group">
        <label for="ce">Centro</label>
        <select name="id_centro"  id="ce" class="form-control" required>
        <?=$CEop?>
        </select>
      </div> 
    </div>

    <div class="col-5">
      <div class="form-group">
        <label for="co">Colegiado</label>
        <select name="id_colegiado" id="co" class="form-control" required>
        <?=$Coop?>
        </select>
      </div> 
    </div>
  </div>

  <!-- TABLE -->
  <div class="form-group table-responsive-sm">
    <table class="table table-bordered table-sm">
      <thead class="thead-light">
        <tr>
          <th style="width:20px">
          <th> Para o ano letivo de</th>
          <th><input type="number" name="anoLetivo" id="anoLetivo" min="2023"></th>
          <th><button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" disabled id="btnAdicionar">Listar</button></th>
          <th><button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" disabled id="btnAdicionar">Adicionar</button></th>
          <th style="width:200px">
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div> 

  
 <!-- TABLE -->
   <div class="form-group table-responsive-sm">
    <table id="tabelaDis" class="table table-bordered table-sm">
      <thead class="thead-light">
        <tr>
          <th>Nome</th>
          <th>Carga horária</th>
          <th>Série</th>
          <th style="width:20px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()" disabled id="btnAdicionar">Adicionar</button></th>
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
            <form class="form-group">
      
              <label for="nome">Nome</label>                  <input type="text" class="form-control" id="nome">
              <label for="instituicao">Carga horária</label>  <input type="text" class="form-control" id="ch">
              <label for="formacao">Série</label>             <input type="text" class="form-control" id="serie">
              <BR><center>
              <button type="button" class="btn btn-secondary btn-sm" onclick="fecharModalDis()">Fechar</button>
              <button type="button" id="addMemb" class="btn btn-primary btn-sm" onclick="adicionarDis()">Adicionar</button>
              <button type="button" name="altMemb" class="btn btn-primary btn-sm" onclick="updatDis(this)">Alterar</button></center>
              
        </form>
        </div>
        

        
      </div>
    </div>
  </div>
  <!-- The Modal Fim-->
  
</div>
 
<script>

  function fecharModalDis(){            
    $('#modalDis').modal('hide');
  }

  function clearModal(){
    document.getElementById("nome").value = "";
    document.getElementById("ch").value = "";
    document.getElementById("serie").value = "";
  }

 function formAddDis(){
    $('#modalDis').modal('show'); 
    document.getElementById("addMemb").hidden = false;
    document.getElementsByName("altMemb")[0].hidden = true;
    clearModal();
    document.getElementById("titleMemb").innerHTML = 'Adicionar disciplina';
    document.getElementById('nome').focus();
  }

  
  

  pegarCA();
 </script>

</body>
</html>

