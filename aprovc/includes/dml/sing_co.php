<?php

require '../../../vendor/autoload.php';
use \App\Session\Login;

use \App\Entity\Vinculo;

// Login::requireLogin();
// $user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    
    $var = $_GET["up"];

    $ano = substr($var, 36, 4);
    $id_colegiado = substr($var, 0, 36);
    
    $where = ' (id_colegiado, ano) = ("'.$id_colegiado.'" , "'.$ano.'"  ) ' ;
    $order = ' 1 ';
    
    $registros = Cargo::gets($where, $order);
    echo json_encode($registros);
    



    if(!$dis->atualizar()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id"        => $dis->id, 
            "idx"       => $data["idx22"],
            "vinculo"   => $dis->vinculo,
            "atividade" => $dis->atividade,
            "estudante" => $dis->estudante,
            "curso"     => $dis->curso,
            "serie"     => $dis->serie,
            "ch"        => $dis->ch
           )
        );
    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
