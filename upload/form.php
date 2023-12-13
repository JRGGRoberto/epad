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
    <table id="tabelaDis" class="table table-bordered table-sm">
      <thead class="thead-light">
        <tr>
          <th>Nome</th>
          <th>Carga horária</th>
          <th>Série</th>
          <th style="width:20px"><button type="button" class="btn btn-primary btn-sm" onclick="formAddDis()">Adicionar</button></th>
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
          <h4 class="modal-title" id="titleMemb">Adicionar disciplina</h4>
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

  // Array para armazenar os equipe
  let disc = [
    {
      "nome": "ESTATÍSTICA APLICADA À PESQUISA CIENTÍFICA - OPTATIVA",
      "ch": "60",
      "serie": "3"
    },
    {
      "nome": "MÍDIAS SOCIAIS E EDUCAÇÃO - OPTATIVA",
      "ch": "60",
      "serie": "3"
    }
  ];
  
  
  function deleteAllRows(){
    $("#tabelaDis tbody tr").remove(); 
  }
  
  function carregarDados(){
     disc.forEach(e => insereTable(e) );
  }
  
  function ordernarByNome(campo, az=true ){
    switch(campo) {
      case 'nome':
        az ? disc.sort((a, b) => a.nome > b.nome) : disc.sort((a, b) => a.nome < b.nome);
        break;
      case 'ch':
        az ? disc.sort((a, b) => a.ch > b.ch) : disc.sort((a, b) => a.ch < b.ch);
        break;
      case 'serie':
        az ? disc.sort((a, b) => a.serie > b.serie) : disc.sort((a, b) => a.serie < b.serie);
        break;
    }

    deleteAllRows();
    carregarDados();
  }

  function clearModalEquipe(){
    document.getElementById("nome").value = "";
    document.getElementById("instituicao").value = "";
    document.getElementById("formacao").value = "";
  }
  
  function fecharModalDis(){            
    $('#modalDis').modal('hide');
  }
             
  // Função para editar contato da tabela
  function formEditarDis(id){
    $('#modalDis').modal('show');
    
    let index = equipe.findIndex(e => e.id === id);
    var myObj = equipe[index];
    
    // Preenche os inputs
    document.getElementById("nome").value        = myObj.nome;
    document.getElementById("ch").value = myObj.ch;
    document.getElementById("serie").value    = myObj.serie;

    
    document.getElementById("titleMemb").innerHTML = 'Editar dados';
    document.getElementById("addMemb").hidden = true;
    let altMemb = document.getElementsByName("altMemb")[0];
    altMemb.hidden = false;
    altMemb.setAttribute("id",  (myObj.id) );              
  };
  
  function formAddDis(){
    $('#modalDis').modal('show');
    document.getElementById("addMemb").hidden = false;
    document.getElementsByName("altMemb")[0].hidden = true;
    clearModalEquipe();
    document.getElementById("titleMemb").innerHTML = 'Adicionar disciplina';
  }
  
  function updatDis(ida) {
    // Obter os valores dos inputs
         
    let idM = parseInt(ida.id);
    let nome = document.getElementById("nome").value;
    let instituicao = document.getElementById("instituicao").value;
    let formacao = document.getElementById("formacao").value;
    let funcao = document.getElementById("funcao").value;
    let telefone = document.getElementById("telefone").value;
     
    
    let dadosAtual = {
      nome: nome,
      ch: ch,
      serie: serie
    };
                
    idx = equipe.findIndex(e => e.id === idM);
  
    equipe[idx] = dadosAtual;

    deleteAllRows();
    carregarDados();
    clearModalEquipe();
    fecharModalDis();
  }
  
  function insereTable(novaLinha){
    // Adicionar uma nova linha na tabela
    let tabela = document.getElementById("tabelaDis").getElementsByTagName("tbody")[0];
    let novaLinha = tabela.insertRow();
      
      let celNome = novaLinha.insertCell(0);
      let celCH = novaLinha.insertCell(1);
      let celSerie = novaLinha.insertCell(2);
      
    celNome.innerHTML = novaLinha.nome;
    celCH.innerHTML = novaLinha.instituicao;
    celSerie.innerHTML = novaLinha.formacao;
    
    celDelete.innerHTML = '<center><button type="button" class="btn btn-light btn-sm" onclick="excluirContato(' + novaLinha.nome + ')">⛔</button><button type="button" class="btn btn-light btn-sm" onclick="formEditarMembro(' + novaLinha.nome + ')">✏️</button></center></center>';
  }
  
  // Função para adicionar um contato na tabela
  function adicionarDis() {
    // Obter os valores dos inputs
    let nome = document.getElementById("nome").value;
    let ch = document.getElementById("ch").value;
    let serie = document.getElementById("serie").value;
      
    if( nome.length > 0 ) {
      // Criar um novo objeto de contato
      let novaLinha = {
        nome: nome,
        ch: ch,
        serie: serie
      };
          
      // Adicionar o novo contato no array
      equipe.push(novaLinha);
         
      //Call preenche <Table>
      insereTable(novaLinha);
              
      // Limpar os inputs
      clearModalEquipe();
      fecharModalDis();
    }
  }
  
  // Função para excluir um contato da tabela
  function excluirContato(nome) {
    // Encontrar o índice do contato no array
    let index = equipe.findIndex(contato => contato.nome === nome);
         
    // Remover o contato do array
    equipe.splice(index, 1);
       
    // Remover a linha correspondente da tabela
    let tabela = document.getElementById("tabelaDis").getElementsByTagName("tbody")[0];
    tabela.deleteRow(index);
  }
  
  carregarDados();
  

  pegarCA();
          </script>

</body>
</html>

