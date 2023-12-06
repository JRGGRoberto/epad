<?php

require '../../../vendor/autoload.php';
use \App\Entity\Vinculo;

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();


if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 
    

    
    if($data["id"] == '') {
        $response = array("status" => "error", "message" => "Método de requisição inválido 1.");
        echo json_encode($response);
        exit;
    }

    $vinculo = new Vinculo();
    $vinculo = $vinculo::get($data['id']);
    $vinculo->obs      = $data["obs"];
   // $vinculo->user         = $user["id"];
    if(!$vinculo->atualizar()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso."
        //"data" => array ($vinculo )
        );
    header('Content-Type: application/json');
    echo json_encode($responseData);

} else {
    
    $response = array("status" => "error", "message" => "Método de requisição inválido.");
    echo json_encode($response);
}
?>
