<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    echo 'mail epad';
    // Passando os dados obtidos pelo formulário para as vari veis abaixo
    $nomeremetente     = 'sergio.dantas@unespar.edu.br';//$_POST['nomeremetente'];
    $emailremetente    = 'sergio.dantas@unespar.edu.br';//trim($_POST['emailremetente']);
    $assunto           = 'Teste ePAD';//$_POST['assunto'];
    $mensagem          = 'Mensagem teste ok EPAD';//$_POST['mensagem'];
    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');

    # Verifica qual é o sistema operacional do servidor para ajustar o cabeçaalho de forma correta
    if(PHP_OS == "Linux") $quebra_linha = "\n"; #____________ Se for Linux
    elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; #__________ Se for Windows
    else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

    # Remetente, assunto e mensagem
    $remetente = 'sergio.dantas@unespar.edu.br';
    $assunto = $assunto . " ($data_envio - $hora_envio)";
    $destino = 'sergio.dantas@unespar.edu.br';


    # Cabeçalho da mensagem
    $headers = "MIME-Version: 1.1" . $quebra_linha;
    $headers .= "Content-type: text/html; charset='utf-8'".$quebra_linha;
    $headers .= "From:".$remetente.$quebra_linha;
    $headers .= "Return-Path: sergio.dantas@unespar.edu.br". $quebra_linha;
    $headers .= "Reply-To: ".$emailremetente.$quebra_linha;

    # Envia mensagem com a senha para o e-mail cadastrado
    mail($destino, $assunto, $mensagem, $headers, "-r". $remetente);

   // header ('location:faleconosco-retorno.php');

   echo '<hr>';
   echo $emailremetente .'<br>';
   echo $hora_envio .'<br>';
   

?>