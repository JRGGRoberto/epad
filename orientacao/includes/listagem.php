<?php
  
  use \App\Entity\Colegiado;
  use \App\Session\Login;
  $user = Login::getUsuarioLogado();

  require('../includes/msgAlert.php');

  define('TITLE','Atividades de Supervisão e Orientação');
  $qnt1 = 0;
  $resultados = '<div id="accordion">';
  foreach($professores as $prof){
    $qnt1++;
    $estiloD = '';


  //VERIFICA PERMISSAO
  //----
  
  
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
      <div class="card-body">';
//
/////tbL
//

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
  <h3 class="mt-0"><?=TITLE?></h3>
  
  <?=$msgAlert?> 

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


