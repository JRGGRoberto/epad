<?php

require '../../vendor/autoload.php';
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();


if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true); 

    $_SESSION['proecunespar']['year_sel'] = $data["ano"];
    $_SESSION['proecunespar']['id_coSel'] = $data["coid"];
     
/*
    $dis =  $dis::getById($data['id_dis']);
    $dis->vinculo       = $data["id_prof"];
    $dis->vinclogchuser = $user["id"];
    if(!$dis->atribuir()){
        $response = array("status" => "error", "message" => "Método de requisição inválido 2.");
        echo json_encode($response);
        exit;
    }
ano: "2025", coid
*/
    
    $responseData = array( 
        "status" => "success",
        "message" => "Dados recebidos com sucesso.",
        "data" => array (
            "ano"       => $data["ano"],
            "co"       => $data["coid"],
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
