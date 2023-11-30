<?php

require '../../../vendor/autoload.php';
use \App\Entity\Vinculo;

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id4"] == '' or $data["idx4"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $pad = new Vinculo();
    $pad = $pad::get($data['id4']);
    $pad->vinculo      = $data["vinc4"];
    $pad->cargo        = $data["cargo4"];
    $pad->alocado      = $data["alocado4"];
    $pad->numdata      = $data["numdata4"];
    $pad->ch           = $data["cargah4"];
    if(!$pad->atualizar()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id4"          => $data["id4"],
            "idx4"         => $data["idx4"],
            "vinc4"        => $pad->vinculo,
            "cargo4"       => $pad->cargo,
            "alocado4"     => $pad->alocado,
            "numdata4"     => $pad->numdata,
            "cargah4"      => $pad->ch,
            )
        );
    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
