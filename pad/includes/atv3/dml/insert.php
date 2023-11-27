<?php

require '../../../../vendor/autoload.php';
use \App\Entity\PADAtiv3;

// use \App\Session\Login;
// Login::requireLogin();
// $user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    /*
    if($data["id3"] != '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    */


    $pad = new PADAtiv3;
    $pad->vinculo      = $data["vinc3"];
    $pad->atividade    = $data["tpProj3"];
    $pad->nome         = $data["nome3"];
    $pad->funcao       = $data["funcao3"];
    $pad->orientandos  = $data["orientandos3"];
    $pad->ch           = $data["cargah3"];
   // $pad->user         = $user["id"];

    $id = $pad->add();

    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id3"           => $id,
            "tpProj3"      => $pad->atividade,
            "nome3"        => $pad->nome,
            "funcao3"      => $pad->funcao,
            "orientandos3" => $pad->orientandos,
            "cargah3"      => $pad->ch
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
