<?php

require '../../vendor/autoload.php';
use \App\Entity\Disciplinas;

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id"] == '' or $data["idx"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $dis = new Disciplinas();
    $dis = $dis::getById($data['id']);
    $dis->nome      = $data["disc"];
    $dis->ch        = $data["ch"];
    $dis->serie     = $data["serie"];
    $dis->user      = $data["uid"];
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
            "nome"      => $dis->nome,
            "ch"        => $dis->ch,
            "serie"     => $dis->serie,
            "idx"       => $data["idx"],
            "cpf"       => '094',
            "status"    => 'Super sucesso!'
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
