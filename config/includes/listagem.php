<?php 

require('../includes/msgAlert.php');

echo 'AEE2: '. $obProjeto->tipo_exten;

?>
<main>
  <h2 class="mt-3">Configuração</h2>
  <?=$msgAlert?>


  <section>


    <table class="table table-light table-borderless" >
        <thead class="table-light">
          <tr>
            <th>Regras de publicação</th>
          </tr>
          <tr><td> </td></tr>
          
        </thead>
        <tbody>
          <tr><th>
<ul class="nav nav-tabs nav-justified" role="tablist">
   <?=$navTabs?>
</ul>

<div class="tab-content">
  <?=$tabPanes?>
<div>
          </th></tr>

        </tbody>
    </table>
  </section>

</main>


