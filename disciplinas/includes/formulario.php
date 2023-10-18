<?php
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
?>
<script src="./jquery.mask.min.js"></script>    
<script src="./ccc.js"></script>
<main>

  <section>
    <a href="index.php">
      <button class="btn btn-sm btn-success float-right">Voltar</button>
    </a>
  </section>

  <h2 class="mt-3"><?=TITLE?></h2>

  <form method="post" id="formprof">
    
    <div class="row">
                          
    <input id="idprf" name="idprf" type="text" hidden value="<?= $obProfessor->id ?>">

      <div class="col-8">
        <div class="form-group">
          <label>Nome</label>
          <input type="text" class="form-control" name="nome" maxlength="60"  value="<?=$obProfessor->nome?>" required>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label>CPF</label>
          <a href="#" data-toggle="tooltip" title="Informe apenas os números" 
          style="text-decoration:none;"><input type="text" class="form-control" name="cpf" id="cpf" maxlength="11" value="<?=$obProfessor->cpf?>" onfocusout="valCPF()" ></a>

        </div>
      </div>

    </div>

    <div class="row">
      <div class="col">

        <div class="form-group">
          <label>Titulação</label>
          <!--<input type="text" class="form-control" name="titulacao" maxlength="65" value="< ?=$obProfessor->titulacao?>" >  -->

          <select  class="form-control" name="titulacao" id="titulacao" maxlength="65" value="<?=$obProfessor->titulacao?>">
            <option value="Mestre">Mestre</option>
            <option value="Doutor">Doutor</option>
            <option value="Bacharel">Bacharel</option>
            <option value="Especialista">Especialista</option>
          </select>
        </div>

      </div>

      <div class="col">
        <div class="form-group">
          <label>Lattes</label>
           <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">http://lattes.cnpq.br/</span>
      </div>
      <input type="text" class="form-control" name="lattes" maxlength="36" value="<?=$obProfessor->lattes?>"></div>
        </div>
      </div>
    </div>
     <div class="row">

      <div class="col">
        
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" class="form-control" name="email" id="email" maxlength="40" value="<?=$obProfessor->email?>" onfocusout="valEmail()" required>
        </div>

      </div>


      <div class="col">
        
        <div class="form-group">
          <label>Telefone</label>
          <input type="tel" class="form-control" name="telefone" maxlength="16" value="<?=$obProfessor->telefone?>">
        </div>

      </div>

    </div>

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

  
    <div class="row">
      <div class="col">
        
        <div class="form-group">
          <label>Categoria funcional</label>
          <div>
              <div class="form-check form-check-inline">
                <label class="form-control">
                  <input type="radio" name="cat_func" value="e" <?=$obProfessor->cat_func == 'e' ? 'checked' : ''?>> Efetivo
                </label>
              </div>
    
              <div class="form-check form-check-inline">
                <label class="form-control">
                  <input type="radio" name="cat_func" value="c" <?=$obProfessor->cat_func == 'c' ? 'checked' : ''?>> Colaborador
                </label>
              </div>
          </div>
        </div>
      </div>

      <div class="col-2">
        <div class="form-group">
<?php
  if($obProfessor->niveln> 0){
     echo '<a href="#" title="Opção não permitida. Esta conta contém a atribuição de '.$obProfessor->nivel.'" data-toggle="popover" data-trigger="hover" data-content="Esta conta contém a atribuição de '.$obProfessor->nivel.' ">';
  }
?>
        <label>Estado da conta 
                    <label for="ativo" class="form-control">Ativa
                        <input type="checkbox" 
<?php
  if($obProfessor->niveln > 0){
     echo 'disabled';
  }
?>
                        name="ativo" value="1" <?=($obProfessor->ativo==1) ? 'checked': '' ?> >
                    </label>
               </label>
<?php
  if($obProfessor->niveln> 1){
     echo '</a>';
  }
?>
        </div>
      </div>

      


     <div class="col">
       <div class="form-group">
         <label>Senha <?= TITLE <> 'Cadastrar professor'? '<span class="badge badge-warning">Não mexa para não alterá-la</span>': null ?> </label>
         <input type="password" class="form-control" name="senha" >
       </div>
     </div>
     <div class="col">
       <!--
        <div class="form-group">
         <label>.</label>
         <input type="password" class="form-control" name="csenha" disabled>
       </div>-->
     </div> 
      
      
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button>
      <button type="reset" class="btn btn-success">Limpar</button>
    </div>

  </form>
<?=$script?>
</main>
