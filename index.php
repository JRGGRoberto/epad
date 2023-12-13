<?php

header('location: ./home');
exit;
/*
require './vendor/autoload.php';

// use \App\Entity\Menu;
use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

$usuario = $usuarioLogado ? $usuarioLogado['nome'].' <a href="../login/logout.php" class"text-light front-weight-bold ml-2">Sair</a>':
'Visitante <a href="login.php" class"text-light front-weight-bold ml-2">Entrar</a>' ;

//$menu = Menu::getRegistros();
$menus = '';
foreach($menu as  $regs){
   $menus.=
   '<div class="col mb-4">
      <div class="card">
        <img src="imgs/logo_unespar.png" width="80" height="80" class="img">
        <div class="card-body">
          <h5 class="card-title"><a href="./'.$regs->path.'">'.$regs->titulo.'</a></h5>
          <p class="card-text">'.$regs->descr.'</p>
        </div>
      </div>
    </div>
';
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>SisGP PROEC</title>
  </head>
  <body class="bg-light text-dark">
  <nav class="navbar navbar-light text-center p-3" style="background-image: linear-gradient(#000000 5%, #D8D8D8 5%, #FFFFFF 75%); ">
    <div style="width: 50%;">
         

    </div>     
  </nav>
    <div class="container">
       <p></p>


  <h1><?=$usuarioLogado['nome']?></h1>
  <a href="login/logout.php">LogOut</a> <br>

<p><br></p>
  <div class="row row-cols-1 row-cols-md-3">
   <?=$menus?>
</div>

<?php

include './includes/footer.php';



