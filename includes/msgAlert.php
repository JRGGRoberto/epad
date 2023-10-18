<?php

$msgAlert = '';
   if(isset($_GET['status'])){
     switch ($_GET['status']) {
       case 'success':
         $msgAlert = 
           '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert">&times;</button>
             Ação executada com sucesso.
           </div>';
         break;
 
       case 'error':
         $msgAlert = 
            '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
               Ação não executada.
             </div>';
         break;
     }
   }