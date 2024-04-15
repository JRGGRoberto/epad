<?php
// $valor = 5;
 echo ($valor ? $valor : 0);
 //ou  -- igual ao de cima, se existir imprime se não imprime o 0
 echo $valor ?  : 0;


 function formartarValor(float $valor): string{
    return number_format($valor, 2, ',','.');
 }

/**
 * Função retorna numero com .000.000
 */
 function formatarNumero(string $numero = null): string{
    return number_format($numero ?: 0,0,'.','.');
 }

date_default_timezone_set('America/Sao Paulo');
$data = date('d/m/Y H:i:s');
echo $data;

function contarTempo(string $data){
   $tempo = strtotime($date('Y-m-d H:i:s'));
   $agora = strtotime($data);
   return $agora - $tempo;
}


?>