<?php

require '../vendor/autoload.php';


use \App\Entity\Usuario;
use \App\Session\Login;

//Obriga o usuário a não estar logado
//Login::requireLogout();

$alertaLogin = '';
$alertaCadastro = '';


//Validação do post
if(isset($_POST['acao'])){
    
  switch($_POST['acao']){
    case 'logar':

      //Busca usuário por e-mail
      $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
   //   $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
   //   $obUsuario->updateSenha();

     //valida a instancia e a senha
      if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)){
        $alertaLogin = "E-mail ou senha inválidos";
        break;
      }

      if($obUsuario->ativo != 1){
        $alertaLogin = "Conta desativada";
        break;
      }

      


      /*
      echo "<pre>";
      print_r($obUsuario);
      echo "</pre>"; exit;
      */
      
      //Loga usuário
      Login::login($obUsuario);


      break;
    
    case 'cadastrar':

      //validacao dos campos obrigatórios
      if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])){

        //Busca usuário por e-mail
        $obUsuario = Usuario::getUsuarioPorEmail($_POST['email']);
        if($obUsuario instanceof Usuario){
          $alertaCadastro = 'O e-mail digitado já está em uso';
          break;
        }

        //Novo usuário
        $obUsuario = new Usuario;
        $obUsuario->nome  = $_POST['nome'];
        $obUsuario->email = $_POST['email'];
        $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
     //   $obUsuario->cadastrar();
        $obUsuario->updateSenha();
     

        //Loga o usuário
        Login::login($obUsuario);


/*    
        echo "<pre>";
        print_r($obUsuario);
        echo "</pre>"; exit;
  */  
      }
      break;
  }
}

include '../includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include '../includes/footer.php';