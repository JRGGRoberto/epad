<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $disc = $_POST["disc"];
    $ch = $_POST["ch"];
    $serie = $_POST["serie"];
    

    $responseData = array(
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array(
            "disc" => $disc,
            "ch" => '90',
            "serie" => $serie
        )
    );
    
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
