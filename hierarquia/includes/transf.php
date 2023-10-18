<main>

  <h2 class="mt-3"><?=TITLE?></h2>
  

  <form method="post">

    <div class="form-group col-8">
      <h3></h3>
      <input type="text" class="form-control" name="nome" value="Campus <?=SUB22?>" readonly>

      
    </div>

    <div class="form-group col-8">
        <?=SUBTITLE?>
          <select name="selCoord"  id="selCoord" class="form-control" onchange="ativaBTN();">
              <?=$OpcoesS ?>
          </select>
          <?=SUBTITLE2?>
    </div>

    <script type="text/javascript">
      var optOrig = document.getElementById('selCoord').value;
           
      function ativaBTN() {
        var btn = document.getElementById('btnOk');
        var opt = document.getElementById('selCoord').value;

        if((opt.length > 22 )  &  (opt != optOrig) ){
          btn.disabled=false;
        } else {
          btn.disabled=true;
        }
      }


    </script>

    <div class="form-group">
      <button id="btnOk" type="submit" class="btn btn-success" disabled>Enviar</button>
   <!--   <a href="index.php"><button class="btn btn-success">Voltar</button></a> -->
    </div> 

  </form>

</main>
