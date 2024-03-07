<form action="">
   <textarea onkeyup="ativaBtn()" maxlength="2000" name="txtresposta" id="txtresposta" cols="30" class="form-control" rows="8"></textarea>
   
   <select name="status" id="status" class="form-group">
     <option value="resolvido">resolvido</option>
     <option value="encaminhado">encaminhado</option>
     <option value="em analise">em analise</option>
   </select>



   <div class="form-group float-right">
        <input id="send" type="submit" value="Salvar observação" class="btn btn-primary btn-sm" > 
   </div>
</form>


<script>

function ativaBtn(){
   const updateObsBtn = document.getElementById('updateObsBtn');
   const txtresposta = document.getElementById('txtresposta');
   if( txtresposta.value.length > 2) {
       send.hidden = false;
    } else {
       send.hidden = true;
    }
}

</script>