<?php
$uri = $_SERVER['REQUEST_URI']; 

$partes = explode('/', trim($uri, '/'));

$urlSys = $partes[0]; // epad

echo $urlSys;


echo '<a href="../" class="btn btn-primary btn-sm">Voltar</a>';
echo phpinfo();