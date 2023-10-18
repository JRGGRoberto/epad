<?php
  
  use \App\Entity\Colegiado;
  use \App\Session\Login;
  $user = Login::getUsuarioLogado();

  require('../includes/msgAlert.php');

  define('TITLE','Editar dados do professor');
  $qnt1 = 0;
  $resultados = '<div id="accordion">';
  foreach($professores as $prof){
    $qnt1++;
    $estiloD = '';


    $colegNome = Colegiado::getRegistro($prof->id_colegiado);
    if($prof->ativo == 0){
      $estiloD = 'style="color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;"';
    } 

    $func;
    ($prof->cat_func == 'e') ? ($func = 'Efetivo') : ($func = 'Colaborador');
    
    $resultados .=  '
<div class="card mt-2">
  <div class="card-header" '. $estiloD .'>
     <div class="row">
        <div class="col-sm-6"><a class="collapsed card-link" data-toggle="collapse" href="#p'. $prof->id .'">👤 '. $prof->nome .'</a></div>
        <div class="col-sm-6"> '.$colegNome->nome.'</div>
     </div>
  </div>
    <div id="p'. $prof->id .'" class="collapse" data-parent="#accordion">
      <div class="card-body">
        <p>Lattes: <a href="http://lattes.cnpq.br/'.$prof->lattes.'" target="_blank">http://lattes.cnpq.br/'.$prof->lattes.'</a></p>
        <p>Email:  <a href="mailto:'.$prof->email.'">'.$prof->email.'</a></p>
        <p>Telefone: <a href="tel:'.$prof->telefone.'">'.$prof->telefone.'</a></p> 
        <p>Titulação: '.$prof->titulacao.'</p>
        <p>'.$func.'</p>
        Alocado em:
        <ul class="breadcrumb p-1 mb-2"">
          <li class="breadcrumb-item"><a href="#">'. $prof->campus.'</a></li>
          <li class="breadcrumb-item"><a href="#">'. $prof->centros.'</a></li>
          <li class="breadcrumb-item"><a href="#">'. $prof->colegiado.'</a></li>
        </ul>';
/// se for coordenador 
        if ($acessoOk){
           $resultados .=  
        '<a href="editar.php?id='. $prof->id .'"><button class="btn btn-success float-right btn-sm mb-2">Editar</button></a>
                                <button id="excluir1" data-target="#myModal" class="btn btn-danger float-right btn-sm mb-2  mr-2" disabled>🗑 Excluir</button>';
        }

     $resultados .=  '
      </div>
    </div>
  </div>';

  }
  $resultados .= '</div>';
  
  $qnt1 > 0 ? $resultados : $resultados = 'Nenhum registro encontrado.';


  //GETS
  unset($_GET['status']);
  unset($_GET['pagina']);
  $gets = http_build_query($_GET);

  //Paginação
  $paginacao = '';
  $paginas   = $obPagination->getPages();
  $paginacao .= '<nav aria-label="Page navigation example">
                  <ul class="pagination pagination-sm">'; 
  foreach($paginas as $key=>$pagina){
    $class = $pagina['atual'] ? 'page-item active': 'page-item';
    $paginacao .= 
      '<li class="'.$class.'">
        <a class="page-link" href="?pagina='.$pagina['pagina'].'&'.$gets.'">'
        .$pagina['pagina']
      .'</a>
       </li>';
  }

  $paginacao .= '</ul>
  </nav>
  ';

?>
<main>
  <h2 class="mt-0">Professores</h2>
  
  <?=$msgAlert?> 

  <section>

    <form method="get">

      <div class="row my-2">


      <div class="row">
      <div class="col-2">
        <div class="form-group">
          <label for="ca">Campus</label>
          <select name="id_campus" id="ca" class="form-control" required>
          <?php
            echo $CAop; 
          ?>
          </select>
        </div> 
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="ce">Centro</label>
          <select name="id_centro"  id="ce" class="form-control" required>
          <?php
            echo $CEop;
          ?>
          </select>
        </div> 
      </div>

      <div class="col-5">
        <div class="form-group">
          <label for="co">Colegiado</label>
          <select name="id_colegiado" id="co" class="form-control" required>
          <?php
            echo $Coop;
          ?>
          </select>
        </div> 
      </div>
    </div>

        <div class="col-1 d-flex align-items-end">
          <button type="submit" class="btn btn-primary btn-sm mr-2">Filtrar</button>
          <a href="./" id="limpar"><span class="badge badge-primary">x</span></a>
        </div>

      </div>

    </form>

  </section>

  <section>

    
    <?=$resultados?>
    
  </section>

  <section>
    <div class="row mt-2 align-bottom">
      <div class="col">
         <?=$paginacao?>
      </div>
      <div class="col" >
      <a href="cadastrar.php"><button class="btn btn-success float-right btn-sm">Novo</button></a>
      </div>
    </div>
  </section>
</main>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Confirmação de exclusão</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Não é possível excluir este registro.
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
        
      </div>
    </div>
  </div>
<!-- The Modal -->



<script>
  const btnOpen = document.getElementById("excluir1");
  const modal = document.querySelector("dialog");
  const btnLimpar = document.getElementById('limpar');

  btnOpen.onclick = function(){
    modal.showModal();
  }


  btnLimpar.hidden = true;

  
  function showLimpar(){
    var nome      = document.getElementById('nome').value;
    var campus    = document.getElementById('campus').value;
    var centro    = document.getElementById('centro').value;
    var colegiado = document.getElementById('colegiado').value;

    if((nome.length > 0 ) | (campus.length > 0)| (centro.length > 0)| (colegiado.length > 0) ) {
      btnLimpar.hidden = false;
    }
  }

  showLimpar();
  
</script>


