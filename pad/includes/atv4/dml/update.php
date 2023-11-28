<?php

require '../../../../vendor/autoload.php';
use \App\Entity\PADAtiv3;

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id3"] == '' or $data["idx3"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $pad = new PADAtiv3();
    $pad = $pad::getById($data['id3']);
    $pad->vinculo      = $data["vinc3"];
    $pad->atividade    = $data["tpProj3"];
    $pad->nome         = $data["nome3"];
    $pad->funcao       = $data["funcao3"];
    $pad->orientandos  = $data["orientandos3"];
    $pad->ch           = $data["cargah3"];
    if(!$pad->atualizar()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id3"          => $data["id3"],
            "idx3"         => $data["idx3"],
            "tpProj3"      => $pad->atividade,
            "nome3"        => $pad->nome,
            "funcao3"      => $pad->funcao,
            "orientandos3" => $pad->orientandos,
            "cargah3"      => $pad->ch,
            "vinc3"        => $pad->vinculo
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
