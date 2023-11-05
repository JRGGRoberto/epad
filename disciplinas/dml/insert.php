<?php

require '../../vendor/autoload.php';
use \App\Entity\Disciplinas;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    if($data["id"] != '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $dis = new Disciplinas;
    $dis->id_matriz = $data["id_matriz"];
    $dis->nome      = $data["disc"];
    $dis->ch        = $data["ch"];
    $dis->serie     = $data["serie"];
    $id = $dis->cadastrar();
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "id"        => $id, //uniqid(),
            "id_matriz" => $dis->id_matriz,
            "nome"      => $data["disc"],
            "ch"        => $data["ch"],
            "serie"     => $data["serie"],
            "cpf"       => '094',
            "status"    => 'Super sucesso'
            )
        );

    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
